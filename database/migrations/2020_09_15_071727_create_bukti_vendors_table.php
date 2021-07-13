<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuktiVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_vendors', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('ordervendor_id')->unsigned();
            $table->foreign('ordervendor_id')->references('id')->on('ordervendors');
            $table->string('namafile');
            $table->string('ext');
            $table->string('keterangan');
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
        Schema::dropIfExists('bukti_vendors');
    }
}
