<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('address_id');
            $table->decimal('total');
            $table->text('notes');
            $table->string('orderno');
            $table->tinyInteger('status'); /// created 1, ready to go 2, on the way 3, teslim edildi 4, cancelled 5,
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
        Schema::dropIfExists('orders');
    }
}