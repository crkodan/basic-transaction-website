<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemcustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemcustomers', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->string('invoice')->unique();
            $table->string('namaPemesan');
            $table->string('jabatanPemesan');
            $table->date('tanggalpo');
            $table->date('jatuhtempo')->nullable();
            $table->date('tanggalkerja')->nullable();
            $table->date('tanggaljadi');
            $table->integer('jumlah');
            $table->integer('hargaSatuan')->nullable();
            $table->integer('hargaTotal')->nullable();
            $table->string('penerimafaktur')->nullable();
            $table->string('statuspelunasan');
            $table->string('statuspesanan');
            $table->string('jenispembayaran');
            $table->string('buktipembayaran')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('itemcustomers');
    }
}
