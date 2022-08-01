<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'body' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'image' => 'sometimes|image:jpeg,jpg|max:1024',
        ];
    }
}
