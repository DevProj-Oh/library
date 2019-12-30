<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function rules()
    {
        switch (request()->getMethod()) {
            case 'POST':
            case 'PATCH':
                return [
                    'title' => 'required',
                    'author' => 'required',
                ];
            default:
                return [];
                break;
        }
    }
}
