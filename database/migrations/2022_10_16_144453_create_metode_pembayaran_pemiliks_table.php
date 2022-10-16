<?php

use App\Models\MetodePembayaran;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('metode_pembayaran_pemiliks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MetodePembayaran::class)->constrained()->cascadeOnDelete();
            $table->string('nomor');
            $table->integer('status')->default(0); //0 = tidak aktif; 1 = aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metode_pembayaran_pemiliks');
    }
};
