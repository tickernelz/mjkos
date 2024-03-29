<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('alamat');
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
            $table->string('ukuran');
            $table->double('harga');
            $table->integer('status');  //0 = kosong; 1 = terisi
            $table->string('cover');
            $table->text('deskripsi');
            $table->integer('jumlah_kamar')->default(0);
            $table->integer('jumlah_kamar_terisi')->default(0);
            $table->tinyInteger('tampil')->default(0);
            $table->integer('jumlah_transaksi')->default(0);
            $table->string('surat_kos')->nullable();
            $table->enum('verifikasi', ['proses', 'sudah', 'ditolak'])->default('proses');
            $table->string('alasan_tolak')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('jumlah_review')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kos');
    }
}
