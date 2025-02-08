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
        Schema::create('booking_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable(); // ID asli booking sebagai referensi
            $table->unsignedBigInteger('user_id')->nullable(); // ID user yang menyetujui
            $table->string('user_name'); // Nama user yang menyetujui
            $table->unsignedBigInteger('vehicle_id');
            $table->string('vehicle_name'); // Nama kendaraan
            $table->unsignedBigInteger('driver_id');
            $table->string('driver_name'); // Nama driver
            $table->string('booking_number')->unique();
            $table->string('booking_name');
            $table->enum('approval_status', ['pending', 'in progress', 'approved', 'rejected'])->default('pending');
            $table->enum('overall_approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('current_approval_level')->default(1);
            $table->timestamp('requested_at')->nullable();
            $table->date('booking_date');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // User yang membuat pemesanan
            $table->text('notes')->nullable(); // Catatan opsional dari approval
            $table->timestamp('changed_at')->nullable();
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_histories');
    }
};