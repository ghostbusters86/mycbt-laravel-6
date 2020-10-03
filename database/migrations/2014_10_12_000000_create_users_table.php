<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedBigInteger('event_id');
            $table->string('asal_sekolah', 100);
            $table->integer('kelas');
            $table->unsignedBigInteger('provinsi_id');
            $table->unsignedBigInteger('kabupaten_kota_id');
            $table->unsignedBigInteger('kecamatan_id');
            $table->text('alamat_tinggal');
            $table->string('no_telepon', 20);
            $table->string('image');
            $table->boolean('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
