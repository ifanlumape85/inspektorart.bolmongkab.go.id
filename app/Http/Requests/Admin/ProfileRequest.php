<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'sometimes|required|email',
            'opening_hours' => 'required|max:255',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'google_plus' => 'max:255',
            'instagram' => 'max:255',
            'about' => 'required',
            'video_embed' => 'required|string|max:255',
            'image' => 'image:png|max:512',
        ];
    }
}
