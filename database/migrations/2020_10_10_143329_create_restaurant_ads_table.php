<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_ads', function (Blueprint $table) {
            $table->id();
            $table->string('link')->nullable();
            $table->text('filename');
            $table->string('link2')->nullable();
            $table->text('filename2');
            $table->string('link3')->nullable();
            $table->text('filename3');
            $table->string('link4')->nullable();
            $table->text('filename4');
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
        Schema::dropIfExists('restaurant_ads');
    }
}