<?php

use App\Models\Kos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePintuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pintu', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kos::class)->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->integer('status');  //0 = kosong; 1 = terisi
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
        Schema::dropIfExists('pintu');
    }
}
