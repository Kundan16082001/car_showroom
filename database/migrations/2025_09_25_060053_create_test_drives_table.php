<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_drives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Correct spelling
            $table->unsignedBigInteger('car_id');   // Correct spelling
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->text('notes')->nullable(); // Optional field for extra information
            $table->string('status')->default('pending'); // pending, approved, completed
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_drives');
    }
};
