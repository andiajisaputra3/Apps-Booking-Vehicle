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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->string('booking_name');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->enum('approval_status', ['pending', 'in progress', 'approved', 'rejected'])->default('pending'); // Status persetujuan individu
            $table->enum('overall_approval_status', ['pending', 'approved', 'rejected'])->default('pending'); // Status persetujuan keseluruhan
            $table->integer('current_approval_level')->default(1); // Level persetujuan saat ini
            $table->timestamp('requested_at')->nullable();
            $table->date('booking_date');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // User yang membuat pemesanan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
