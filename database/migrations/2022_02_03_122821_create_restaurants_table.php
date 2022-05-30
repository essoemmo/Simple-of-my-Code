<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name')->default('restaurant');
            $table->string('email')->unique();
            $table->string('phone')->unique()->default('+966555111555');
            $table->string('password');
            $table->boolean('isVerified')->default(false);
            $table->boolean('active')->default(true);
            $table->string('google_token')->nullable();
            $table->integer('code')->default('0000')->unique();
            $table->string('image')->default('default.png');
            $table->string('cover')->default('default.png');
            $table->string('lat')->default('00.0000000');
            $table->string('lang')->default('00.0000000');
            $table->string('address')->default('address');
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->integer('resrv_numb')->default('0');
            $table->foreignId('type_place_id')->nullable()->constrained('type_places')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('restaurants');
    }
}
