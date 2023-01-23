<?php

namespace App\Http\Requests\Post;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*Este método sirve para verificar que el usuario que realiza el request esté autorizado
        para tal fin (por ejemplo que sea admin, etc.). Para poder usar la validación definida en la clase
        debe retornar true*/
        
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //Aquí aplicamos las reglas de validación
            'title'=> 'required|min:5|max:255',
            'slug'=> 'required|min:5|max:255|unique:posts,slug,'.$this->route("post")->id,
            //La condicoon ",slug'.$this->route("post")->id es para no comprobar la unicidad del
            //slug cuando estamos editando el post.
            'content'=> 'required|min:10',
            'category_id'=> 'required|integer',
            'description'=> 'required|min:10',
            'posted'=> 'required',
            'image'=>'mimes:jpeg,jpg,png|max:20480'
        ];
    }
}
