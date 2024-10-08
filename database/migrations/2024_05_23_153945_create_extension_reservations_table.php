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
        Schema::create('extension_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')
            ->constrained('reservations')
            ->cascadeOnDelete()
            ->cascadeOnUbdate();
            $table->foreignId('extension_id')
            ->constrained('extensions')
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
        Schema::dropIfExists('extension__reservations');
    }
};
