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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('divisi_id')->nullable();
            $table->foreignUuid('prodi_id')->nullable();
            $table->string('name')->unique();
            $table->text('address');
            $table->string('no_telp')->nullable();
            $table->string('img')->nullable();
            $table->enum('role', ['ketua', 'wakil ketua', 'sekertaris', 'bendahara', 'kadiv', 'anggota']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
