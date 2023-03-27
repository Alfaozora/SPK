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
        Schema::create('crips', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_crips');
            $table->primary('id_crips');
            $table->integer('id_kriteria');
            $table->string('nama');
            $table->string('keterangan');
            $table->double('nilai');
            $table->timestamps();
        });

        Schema::table('crips', function ($table) {
            $table->foreign('id_kriteria')
                ->references('id_kriteria')
                ->on('kriterias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crips');
    }
};
