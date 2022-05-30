<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('category_id')->nullable()->constrained('categories')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->text('short_desc_ar')->nullable();
            $table->text('short_desc_en')->nullable();

            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            $table->decimal('main_price',10,2)->nullable();

            $table->boolean('active')->default(true);

            $table->string('image')->default('default.png');

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
        Schema::dropIfExists('products');
    }
}
