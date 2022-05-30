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
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->default('+966555111555');
            $table->boolean('isVerified')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('code')->default('0000')->unique();
            $table->string('image')->default('default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('lat')->default('00.0000000');
            $table->string('lang')->default('00.0000000');
            $table->string('address')->default('address');
            $table->string('google_token')->nullable();
            $table->string('password');
            $table->string('fcm_token')->nullable();
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
