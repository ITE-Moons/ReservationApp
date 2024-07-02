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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')
            ->constrained('places')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
            $table->foreignId('type_id')
            ->constrained('types')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
            $table->double('total_price');
            $table->date('date_and_time');
            $table->enum('day',['Sun','Mon','Tue','Wed','Thu','Fri','Sat']);
            $table->time('start_time');
            $table->dateTime('end_time');
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
};
