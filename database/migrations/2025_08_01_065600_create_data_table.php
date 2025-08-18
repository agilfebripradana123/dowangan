<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16);
            $table->string('nama_lengkap', 100);
            $table->text('alamat')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->nullable();
            $table->string('agama', 20)->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->nullable();
            $table->string('status_keluarga', 30)->nullable();
            $table->string('pendidikan_terakhir', 50)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('kewarganegaraan', 5)->default('WNI');
            $table->boolean('disabilitas')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data');
    }
}

