<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules for updating a user.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'  => 'required',
            'about' => 'required',
        ];
    }
}

