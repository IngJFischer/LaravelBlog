<?php

namespace Database\Seeders;

use App\Models\Category;

use PhpParser\Node\Stmt\For_;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Limpiar la base de datos. Primero deshabilitamos las restricciones de clave foranea,
        //Truncamos la tabla y rehabilitamos las restricciones.
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i=0; $i <20; $i++){
            Category::create(
                [
                'title' => "Categoría $i",
                'slug' => "categoria-$i",
                ]);
        }
    }
}
