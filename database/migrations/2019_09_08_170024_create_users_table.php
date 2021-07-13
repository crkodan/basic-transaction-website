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

            $table->increments('id');
            $table->string('name', 30);
            $table->string('email')->unique();            
            $table->string('password');
            $table->enum('role',['admin','customer','vendor'])->default('admin');
            $table->rememberToken();
            $table->string('active');
            // $table->integer('vendor_id')->unsigned();
            // $table->foreign('vendor_id')->references('id')->on('vendors');
            // $table->integer('itemCustomer_id')->unsigned();
            // $table->foreign('itemCustomer_id')->references('id')->on('itemCustomers');
            //kudue iki vendor id mbe iki ga disini berarti wkwkwk
            // kayake kudu mikir, iki foreign key ne dari mana berarti, kan rencanae antara item customers sama vendor hubungan ke user e gimana
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
