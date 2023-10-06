<?php

namespace App\Http\Requests\Exhibitions\Foreign;

use Illuminate\Foundation\Http\FormRequest;

class UpdateForeignExhibitionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'     => 'required|min:3|max:255',
            'title_en'  => 'nullable|min:3|max:255',
            'title_tk'  => 'nullable|min:3|max:255',
            'date'      => 'nullable',
            'thumbnail' => 'nullable|image',
            'file'      => 'nullable|file|mimes:doc,pdf,docx',
            'file_tk'   => 'nullable|file|mimes:doc,pdf,docx',
            'file_en'   => 'nullable|file|mimes:doc,pdf,docx',
        ];
    }
}