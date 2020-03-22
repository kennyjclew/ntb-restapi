<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarparksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //        
        Schema::create('carparks', function (Blueprint $table) {
            $table->string('car_park_no')->primary();
            $table->integer('total_lots')->nullable();
            $table->integer('available_lots')->nullable();
            $table->timestamp('updated_at');
            $table->string('address', 256);
            $table->double('x_coord');
            $table->double('y_coord');
            $table->string('car_park_type');
            $table->string('type_of_parking_system');
            $table->string('short_term_parking');
            $table->string('free_parking');
            $table->string('night_parking');
            $table->integer('car_park_decks');
            $table->integer('gantry_height');
            $table->string('car_park_basement');
            $table->integer('_id');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('carparks');
    }
}


?>
