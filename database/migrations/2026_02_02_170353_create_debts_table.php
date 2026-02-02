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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['borrowed', 'gave']);
            $table->decimal('total_amount', 15, 2);
            $table->string('note')->nullable();
            $table->date('date');
            $table->date('due_date')->nullable();
            $table->enum('source', ['Cash', 'Cheque', 'Other'])->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('source_other')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'customer_id']);
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
