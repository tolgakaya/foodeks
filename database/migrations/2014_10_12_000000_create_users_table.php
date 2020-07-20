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
        //role 1 admin (genel yönetici her şeyi yapabilir)
        //role 2 müşteri (müşteri, kendi hesabını görüntüleyebilir)
        //role 3 müdür(sube yada restaurant yöneticisi, kendi restaurantının siparişlerini vb görür)
        //role 4 paketci

        //burada restaurant_id alanı nullabele. Restaurant_id ile tanımlanırsa o restauranttan sorumlu olur

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('adi');
            $table->integer('role')->default(2);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->string('mobile')->nullable();
            $table->rememberToken();
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