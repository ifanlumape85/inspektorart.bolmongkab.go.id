<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LayananRequest extends FormRequest
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
            'id_jenis' => 'required|integer|exists:jenis,id',
            'id_jenis_layanan' => 'required|integer|exists:jenis_layanans,id',
            'deskripsi' => 'required'
        ];
    }
}
