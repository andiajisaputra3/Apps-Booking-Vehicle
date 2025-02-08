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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Pemesanan terkait
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User yang menyetujui
            $table->integer('approval_level'); // Level persetujuan (1, 2, 3, dst.)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status persetujuan
            $table->text('notes')->nullable(); // Catatan opsional
            $table->timestamp('approved_at')->nullable(); // Waktu persetujuan
            $table->string('approval_role')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};