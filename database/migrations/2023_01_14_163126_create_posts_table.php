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

    /**Creamos la tabla 'posts' en la base de datos. La misma contiene las columnas:
    'id', 'title', 'slug', 'description', 'content', 'image', 'posted',
    claves de tiempo automáticas ('created_at' y 'updated_at') y la clave foranea
    'category_id'.*/

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('slug',255);
            $table->text('description');
            $table->text('content');
            $table->string('image',255);
            $table->enum('posted', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
