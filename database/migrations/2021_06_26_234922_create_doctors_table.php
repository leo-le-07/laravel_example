<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->rowFormat = 'DYNAMIC';
            
            $table->id();
            $table->unsignedBigInteger('hospital_id');
            $table->string('name');
            $table->string('email', 50)->unique();
            $table->tinyInteger('gender');
            $table->text('description')->nullable();
            $table->string('avatar')->nullable();

            
            $table->foreign('hospital_id')->references('id')->on('hospitals');

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
        Schema::dropIfExists('doctors');
    }
}
