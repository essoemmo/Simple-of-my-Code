<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('order_status_id')->nullable()->constrained('order_statuses')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('order_type_id')->nullable()->constrained('order_types')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('coupon_id')->nullable()->constrained('coupons');

            $table->date('date')->nullable();
            $table->time('time')->nullable();
            
            $table->foreignId('type_place_id')->nullable()->constrained('type_places')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->text('note')->nullable();
            $table->integer('table_number')->nullable();

            $table->decimal('sub_total',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('total',10,2)->nullable();

            $table->string('pay_type')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
