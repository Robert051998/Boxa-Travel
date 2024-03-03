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
        Schema::create('property_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->enum('status',['Available', 'Not available'])->default('Available'); 
            $table->integer('price')->default(0);
            $table->tinyInteger('min_stay')->default(0);
            $table->integer('min_day')->default(0);
            $table->date('date')->nullable();
            $table->string('color', 150)->nullable();
            $table->enum('type',['calendar', 'normal'])->default('normal'); 
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
        Schema::dropIfExists('property_dates');
    }
};
