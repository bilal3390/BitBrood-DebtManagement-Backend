<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('user_phone_e164');
            $table->string('customer_phone_e164');
            $table->enum('type', ['borrowed', 'gave']);
            $table->decimal('total_amount', 15, 2);
            $table->string('note')->nullable();
            $table->date('date');
            $table->date('due_date')->nullable();
            $table->enum('source', ['Cash', 'Cheque', 'Other'])->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('source_other')->nullable();
            $table->timestamps();

            $table->foreign('user_phone_e164')->references('user_phone_e164')->on('users')->cascadeOnDelete();
            $table->foreign('customer_phone_e164')->references('customer_phone_e164')->on('customers')->cascadeOnDelete();

            $table->index(['user_phone_e164', 'customer_phone_e164']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
