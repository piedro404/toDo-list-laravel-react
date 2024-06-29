<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id ?? '';

        $rules = [
            'title'=> [
                'required',
                'string', 
                'min:3',
                'max:255', 
            ],
            'description'=> [
                'nullable',
                'string', 
                'min:3',
                'max:255', 
            ],
            'deadline'=> [
                'nullable',
                'date', 
            ],
        ];

        return $rules;
    }
}
