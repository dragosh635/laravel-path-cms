<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules for updating a post.
     *
     * @return array
     */
    public function rules() {
        return [
            'title'       => 'required',
            'description' => 'required',
            'content'     => 'required',
            'category_id' => 'required',
        ];
    }
}
