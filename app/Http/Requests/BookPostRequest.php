<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookPostRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'isbn' => 'required|numeric|digits_between:10,13',
            'title' => 'required',
            'author_id' => 'required',
            'image_path' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'pages' => 'required|numeric|min:1|max:2000',
            'language' => 'required',
            'publish_date' => 'required',
            'subjects' => 'required',
            'desc' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'isbn.required' => 'ISBN field is required.',
            'isbn.numeric' => 'ISBN field must be a number.',
            'isbn.digits_between' => 'ISBN field must be between 10 and 13 digits.',
            'title.required' => 'Title field is required.',
            'author.required' => 'Author field is required.',
            'image_path.required' => 'Image path field is required.',
            'publisher.required' => 'Publisher field is required.',
            'category.required' => 'Category field is required.',
            'pages.required' => 'Pages field is required.',
            'pages.numeric' => 'Pages field must be a number.',
            'pages.min' => 'Pages field must be at least :min.',
            'pages.max' => 'Pages field must not exceed :max.',
            'language.required' => 'Language field is required.',
            'publish_date.required' => 'Publish date field is required.',
            'subjects.required' => 'Subjects field is required.',
            'desc.required' => 'Description field is required.',
        ];
    }
}
