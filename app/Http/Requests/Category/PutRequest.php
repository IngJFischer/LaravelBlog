<?php

namespace App\Http\Requests\Category;

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
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['slug' => Str::slug($this->title)]);
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
