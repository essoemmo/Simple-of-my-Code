<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('product_id')->nullable()->constrained('products')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('type_id')->nullable()->constrained('types')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->integer('qty')->nullable();

            $table->decimal('sub_total',10,2)->nullable();

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
        Schema::dropIfExists('carts');
    }
}
