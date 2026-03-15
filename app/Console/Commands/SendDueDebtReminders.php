<?php

namespace App\Console\Commands;

use App\Jobs\SendExpoPushNotificationsJob;
use App\Models\Debt;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'debt:send-due-reminders',
    description: 'Send push notifications to users and customers who have debts due tomorrow.'
)]
class SendDueDebtReminders extends Command
{
    public function handle(): int
    {
        $tomorrow = Carbon::now()->addDay()->toDateString();

        $this->info("Checking debts due on {$tomorrow}...");

        $debts = Debt::query()
            ->whereDate('due_date', $tomorrow)
            ->get();

        if ($debts->isEmpty()) {
            $this->info('No debts found with due date tomorrow.');
            return self::SUCCESS;
        }

        $userPhones = [];
        $customerPhones = [];

        foreach ($debts as $debt) {
            if (!empty($debt->user_phone_e164)) {
                $userPhones[] = $debt->user_phone_e164;
            }
            if (!empty($debt->customer_phone_e164)) {
                $customerPhones[] = $debt->customer_phone_e164;
            }
        }

        $userPhones = array_values(array_unique($userPhones));
        $customerPhones = array_values(array_unique($customerPhones));

        // Customers who are also users (have installed the app)
        $customerUserPhones = [];
        if (!empty($customerPhones)) {
            $customerUserPhones = User::query()
                ->whereIn('user_phone_e164', $customerPhones)
                ->pluck('user_phone_e164')
                ->all();
        }

        $allPhones = array_values(array_unique(array_merge($userPhones, $customerUserPhones)));

        if (empty($allPhones)) {
            $this->info('No users/customers with the app installed for due debts.');
            return self::SUCCESS;
        }

        $tokens = DeviceToken::query()
            ->whereIn('user_phone_e164', $allPhones)
            ->pluck('token')
            ->unique()
            ->values()
            ->all();

        if (empty($tokens)) {
            $this->info('No device tokens found for users/customers with due debts.');
            return self::SUCCESS;
        }

        $title = 'Debt due tomorrow';
        $body = 'You have one or more debts due tomorrow. Please review them in the app.';

        SendExpoPushNotificationsJob::dispatch(
            $tokens,
            $title,
            $body,
            [
                'type' => 'debt_due_tomorrow',
                'due_date' => $tomorrow,
            ]
        );

        $this->info('Queued push notifications for ' . count($tokens) . ' device(s).');

        return self::SUCCESS;
    }
}

