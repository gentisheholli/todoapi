<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'due_date' => 'required',
            'status' => 'required|string|min:1|max:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'due_date.required' => 'Due date is required!',
            'status.required' => 'Status is required!'
        ];
    }
}
