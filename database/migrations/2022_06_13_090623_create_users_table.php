<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('manager_name')->nullable();
            $table->string('manager_phone')->nullable()->unique();
            $table->string('commercial')->nullable();
            $table->date('birthday')->nullable();
            $table->string('password');
            $table->string('id_number')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('image')->default('default.png');
            $table->string('description')->nullable();
            $table->string('blood_type')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('active')->default(0);
            $table->integer('code')->default(1111);
            $table->double('balance',8,2)->default(0);
            $table->string('google_token')->nullable();
            $table->string('national_address')->nullable();
            $table->boolean('is_draw')->default(0);

            $table->foreignId('language_id')->nullable()->constrained('languages')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('relation_id')->nullable()->constrained('relations')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('type_id')->nullable()->constrained('types')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('national_id')->nullable()->constrained('nationals')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('sex_id')->nullable()->constrained('sexes')->onUpdate('cascade')->onDelete('set null');

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
};
