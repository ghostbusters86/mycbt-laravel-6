<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('penilaian_id');
            $table->longText('jawaban');
            $table->enum('benar_salah', ['Y', 'N']);
            $table->decimal('point', 6, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans')->onDelete('cascade');
            $table->foreign('penilaian_id')->references('id')->on('penilaians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawabans');
    }
}
