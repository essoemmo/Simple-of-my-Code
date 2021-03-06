<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('order_status_id')->nullable()->constrained('order_statuses')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('sets')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
