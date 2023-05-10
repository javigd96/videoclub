<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return match($this->method()) {
            "POST" =>[
                "title" =>"required|min:2|max:40|unique:films,title,",
                "category_id" => "required|exists:categories,id",
                "synopsis" =>"min:5|max:500",
                "year" =>"required|integer|between:1940,2023",
                "director"=>"required|min:2|max:40",
                "rented" =>"required|in: 0,1",
                "poster" =>"required|image|mimes:png,jpg,jpeg,gif,svg|max:1024",
            ],
            "PUT" =>[
                
                "title" =>"required|min:2|max:40".$this->route('film')->id,
                "category_id" => "required|exists:categories,id",
                "synopsis" =>"min:5|max:500",
                "year" =>"required|integer|between:1940,2023",
                "director"=>"required|min:2|max:40",
                "rented" =>"required|in: 0,1",
                "poster" =>"required|image|mimes:png,jpg,jpeg,gif,svg|max:1024",
            ]
        };
            
    }
}
