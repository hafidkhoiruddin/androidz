<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('soccer_field_id');
            $table->date('date');
            $table->char('start_time', 5);
            $table->char('end_time', 5);
            $table->integer('price')->default(0);
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('vendor_id')->references('id')
                ->on('vendors');
            $table->foreign('soccer_field_id')->references('id')
                ->on('soccer_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
