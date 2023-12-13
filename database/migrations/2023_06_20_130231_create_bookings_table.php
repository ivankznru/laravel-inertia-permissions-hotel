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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('days');
            $table->decimal('price', 8,2);
            $table->foreignId('room_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('started_at');
            $table->timestamp('finished_at');
            $table->timestamps();
        });
    }
//● id INT NOT NULL
//● room_id FK INT NOT NULL
//● user_id FK INT NOT NULL
//● started_at TIMESTAMP NOT NULL
//● finished_at TIMESTAMP NOT NULL
//● days INT NOT NULL
//● price INTEGER NOT NULL
//● created_at TIMESTAMP NULLABLE
//● updated_at TIMESTAMP NULLABLE
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
