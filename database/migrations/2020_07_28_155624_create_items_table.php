<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('jenisItem');
            $table->string('tipeitem');
            $table->integer('stockjumlah');
            $table->integer('hargabeli');
            $table->integer('hargajual');
            $table->string('catatan')->nullable();
            $table->enum('satuan',['pcs','lusin','meteran','kodi','rim'])->default('pcs');
            $table->integer('jumlahminimal');
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
        Schema::dropIfExists('items');
    }
}
