<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('company');
            $table->string('style');
            $table->boolean('payment_card')->nullable();
            $table->boolean('payment_setcard')->nullable();
            $table->boolean('payment_ticket')->nullable();
            $table->boolean('payment_multinet')->nullable();
            $table->boolean('payment_cash')->nullable();
            $table->decimal('radius_service')->default(5);
            $table->boolean('multi_branch')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
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
        Schema::dropIfExists('page_settings');
    }
}