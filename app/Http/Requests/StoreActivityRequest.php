<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'activity_date' => [
                'required',
                'date',
            ],

            'code' => [
                'nullable',
                'string',
                'max:30',
                'unique:activities,code',
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],
        ];
    }
}
