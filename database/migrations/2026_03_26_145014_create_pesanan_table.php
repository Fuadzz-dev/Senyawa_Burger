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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->integer('id_pesanan', true);
            $table->integer('id_user')->index('idx_pesanan_user');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending')->index('idx_pesanan_status');
            $table->decimal('total_harga', 12)->default(0);
            $table->string('no_telepon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('nama', 100);
            $table->enum('tipe_order', ['dine_in', 'take_away', 'delivery'])->default('dine_in');
            $table->boolean('status_lunas')->default(false);
            $table->timestamp('created_at')->useCurrent()->index('idx_pesanan_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
