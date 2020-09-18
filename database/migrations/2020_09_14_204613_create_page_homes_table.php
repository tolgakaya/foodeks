<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_homes', function (Blueprint $table) {
            $table->id();
            $table->string('video');
            $table->string('slogan');
            $table->string('sub_slogan');
            $table->boolean('show_how')->default(true);
            $table->boolean('restaurant_list_show')->default(false);
            $table->boolean('menu_show');
            $table->boolean('paralax_show')->default(true);
            $table->string('paralax_image')->nullable();
            $table->string('paralax_text')->nullable();
            $table->string('paralax_sub_text')->nullable();
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
        Schema::dropIfExists('page_homes');
    }
}