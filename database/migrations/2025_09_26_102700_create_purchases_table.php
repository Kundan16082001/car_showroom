<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('test_drive_id')->nullable();

            // Purchase details
            $table->date('purchase_date')->default(now());
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('cash'); // cash, credit, etc.
            $table->string('payment_status')->default('pending'); // pending, completed, cancelled

            $table->timestamps();

            // FIXED FOREIGN KEYS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('test_drive_id')->references('id')->on('test_drives')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
