<?php

namespace App\Http\Requests\Tags;

use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules creating a tag.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|unique:tags',
        ];
    }
}
