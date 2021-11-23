<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTask extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required','min:3'],
            'type' => ['required', Rule::in(['invoice_ops', 'custom_ops', 'common_ops'])],
        ];
    }

    public function messages()
    {
        return [
          'title.required' => 'Title field is required',
          'title.min' => 'Title field must be minimum :min characters',
          'type.required' => 'Type field is required',
          'type.in' => 'The type field must be one of these: :in',
        ];
    }
}
