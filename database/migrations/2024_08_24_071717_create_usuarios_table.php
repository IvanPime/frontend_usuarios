<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('title', 10); 
            $table->string('first', 50); 
            $table->string('last', 50); 
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->string('postcode', 20); 
            $table->string('email', 100)->unique(); 
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
        Schema::dropIfExists('usuarios');
    }
}
