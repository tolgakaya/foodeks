<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('meal_id');
            $table->string('meal_name');
            $table->decimal('meal_price');
            $table->integer('quantity');
            $table->unsignedBigInteger('option_id')->nullable();
            $table->string('option_name')->nullable();
            $table->decimal('option_price')->nullable();
            $table->decimal('extras_price')->nullable();
            $table->json('extras')->nullable();
            $table->decimal('sub_total');
            $table->decimal('discount');
            $table->decimal('total');
            $table->timestamps();
            ///başka bir tabloda sipariş hakkında notlar eklenebilir.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}