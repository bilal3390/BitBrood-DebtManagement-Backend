<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('user_phone_e164');
            $table->string('token', 500);
            $table->string('platform', 20)->default('android'); // android, ios
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->foreign('user_phone_e164')
                ->references('user_phone_e164')
                ->on('users')
                ->cascadeOnDelete();
            $table->unique(['user_phone_e164', 'token']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_tokens');
    }
};
