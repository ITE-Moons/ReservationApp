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
        Schema::create('available_times', function (Blueprint $table) {
            $table->id();
            $table->enum('day',['Sun','Mon','Tue','Wed','Thu','Fri','Sat']);
            $table->time('from_time');
            $table->time('to_time');
            $table->boolean('is_Active');
            $table->foreignId('place_id')
            ->constrained('places')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
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
        Schema::dropIfExists('available_times');
    }
};
