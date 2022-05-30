<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantAminitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_aminities', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('amenity_id')->nullable()->constrained('amenities')->onUpdate('cascade')
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
        Schema::dropIfExists('restaurant_aminities');
    }
}
