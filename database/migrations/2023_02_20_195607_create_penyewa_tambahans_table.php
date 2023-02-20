<?php

use App\Models\Transaksi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('penyewa_tambahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->string('nama');
            $table->string('ktp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyewa_tambahans');
    }
};
