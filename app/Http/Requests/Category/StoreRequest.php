<?php

namespace App\Http\Requests\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['slug' => Str::slug($this->title)]);
    }

    function failedValidation(Validator $validator)
    {
        //Aca ponemos que devolver si falla la validación en la API
        if ($this->expectsJson()){
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        };

        //Esto hace que funcione la validación web en conjunto con la de API
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:10|unique:categories',
            'slug' => 'required|min:3|unique:categories'
        ];
    }
}
