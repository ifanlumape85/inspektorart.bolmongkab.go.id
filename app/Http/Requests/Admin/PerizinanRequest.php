<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PerizinanRequest extends FormRequest
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
            'nama_perizinan' => 'required|max:255',
            'persyaratan' => 'required|max:255',
            'biaya' => 'required|max:255',
            'cara_penanganan' => 'required',
            'waktu' => 'required'
        ];
    }
}
