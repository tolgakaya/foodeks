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
            $table->boolean('payment_card')->default(true);
            $table->boolean('payment_setcard')->default(true);
            $table->boolean('payment_ticket')->default(true);
            $table->boolean('payment_multinet')->default(true);
            $table->boolean('payment_cash')->default(true);
            $table->decimal('radius_service')->default(5);
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