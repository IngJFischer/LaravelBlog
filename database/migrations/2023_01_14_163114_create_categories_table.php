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

    /*Creamos la tabla 'categories' en la base de datos. La misma contiene las columnas:
    'id', 'title', 'slug' y claves de tiempo automáticas ('created_at' y 'updated_at').
    Es importante que esta tabla se cree antes que las de 'posts' ya que aquella contiene
    una clave foranea apuntada a esta tabla.*/
    
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
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
        Schema::dropIfExists('categories');
    }
};
