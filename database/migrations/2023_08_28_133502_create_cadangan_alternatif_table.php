<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadangan_alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nkk');
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nomor');
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
        Schema::dropIfExists('cadangan_alternatif');
    }
};
