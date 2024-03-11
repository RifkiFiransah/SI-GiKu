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
        Schema::create('prokers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('divisi_id')->nullable();
            $table->foreignUuid('user_id')->nullable();
            $table->string('name_proker');
            $table->text('description')->nullable();
            $table->enum('status', ['belum', 'sedang berjalan', 'selesai', 'tidak berjalan']);
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokers');
    }
};
