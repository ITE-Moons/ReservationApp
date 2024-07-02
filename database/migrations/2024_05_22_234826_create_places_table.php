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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('owner_id')
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
            $table->integer('maximum_capacity');
            $table->double('price_per_hour');
            $table->double('space');
            $table->text('license');
            $table->foreignId('category_id')
            ->constrained('categories')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
            $table->boolean('status');
            $table->enum('day_hour',['DAYS','HOURS']);
        //    $table->boolean('isFavourite');
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
        Schema::dropIfExists('places');
    }
};
