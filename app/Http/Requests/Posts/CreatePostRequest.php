<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules for creating a post.
     *
     * @return array
     */
    public function rules() {
        return [
            'title'       => 'required|unique:posts',
            'description' => 'required',
            'content'     => 'required',
            'image'       => 'required|image',
            'category_id' => 'required',
        ];
    }
}
