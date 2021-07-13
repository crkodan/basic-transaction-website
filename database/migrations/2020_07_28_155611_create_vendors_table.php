<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('namaVendor')->unique();
            $table->string('pemilikVendor');
            $table->string('brandVendor');
            $table->string('alamatVendor');
            $table->string('kotaVendor');
            $table->string('jenisUsahaVendor');
            $table->string('kategoriVendor');
            $table->string('catatanVendor')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('vendors');
    }
}
