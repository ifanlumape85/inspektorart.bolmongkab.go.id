<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PengaduanRequest extends FormRequest
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
            // 'id_user' => 'required|integer|exists:users,id',
            'judul' => 'required|string|max:255',
            'uraian' => 'required',
            'lokasi' => 'required|string|max:255',
            'waktu' => 'required|string|max:255',
            'penyebab' => 'required|string|max:255',
            'proses' => 'required|string|max:255',
            'kerugian' => 'required|integer',
            'bukti' => 'sometimes|image:jpg,jpeg',
            'nama' => 'required|array',
            'alamat' => 'required|array',
            'jabatan' => 'required|array',
        ];
    }
}
