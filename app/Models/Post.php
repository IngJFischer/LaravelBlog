<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Declaramos que elementos de la base de datos podemos asignar desde el controlador
    protected $fillable = ['title',
    'category_id',
    'slug',
    'description',
    'content',
    'posted',
    'image'];
    use HasFactory;

    public function Category()
    {
        //Función que nos retorna datos en una relación uno a muchos
        return $this->belongsTo(Category::class);
    }

}
