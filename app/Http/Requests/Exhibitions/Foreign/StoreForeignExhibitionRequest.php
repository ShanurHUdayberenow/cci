<?php

namespace App\Http\Requests\Exhibitions\Foreign;

use Illuminate\Foundation\Http\FormRequest;

class StoreForeignExhibitionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'     => 'required|string|min:3|max:255',
            'title_en'  => 'nullable|string|min:3|max:255',
            'title_tk'  => 'nullable|string|min:3|max:255',
            'date'      => 'required|string',
            'thumbnail' => 'nullable|image',
            'file'      => 'nullable|file|mimes:doc,pdf,docx',
            'file_tk'   => 'nullable|file|mimes:doc,pdf,docx',
            'file_en'   => 'nullable|file|mimes:doc,pdf,docx',
        ];
    }
}