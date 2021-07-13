<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdervendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordervendors', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('itemcustomer_id')->unsigned();
            $table->foreign('itemcustomer_id')->references('id')->on('itemcustomers');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->string('orderinvoice')->unique();
            $table->date('tanggalpo');
            $table->date('jatuhtempo')->nullable();
            $table->date('tanggalkerja')->nullable();
            $table->date('tanggaljadi')->nullable();
            $table->integer('jumlah');
            $table->integer('biaya')->nullable();
            $table->integer('hargajual')->nullable();
            $table->string('statuspelunasan');
            $table->string('statuskerja');
            $table->string('uploadfaktur')->nullable();
            $table->string('uploadbuktipenerimaan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('statusdeal')->nullable();
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
        Schema::dropIfExists('ordervendors');
    }
}
