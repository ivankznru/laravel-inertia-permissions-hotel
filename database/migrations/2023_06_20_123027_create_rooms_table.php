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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('poster_url');
            $table->decimal('floor_area', 8, 2);
            $table->string('type');
            $table->decimal('price', 8,2);
            $table->foreignId('hotel_id')->constrained();
            $table->timestamps();
        });
    }
//● id INT NOT NULL
//● title VARCHAR(100) NOT NULL
//● description TEXT NULLABLE
//● poster_url VARCHAR(100) NULLABLE
//● floor_area NUMERIC(8,2) NOT NULL
//● type VARCHAR(100) NOT NULL
//● price INTEGER NOT NULL
//● hotel_id FK INT NOT NULL
//● created_at TIMESTAMP NULLABLE
//● updated_at TIMESTAMP NULLABLE

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
