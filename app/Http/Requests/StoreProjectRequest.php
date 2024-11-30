<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date',
            'subtotal' => 'required|numeric',
            'client_id' => 'required|exists:clients,id|unique:projects,client_id',
            'concept' => 'nullable',
            'status' => 'nullable',
            'comments' => 'nullable|string|max:200',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Project name is required',
            'name.max' => 'Project name must be 100 stringacters',
            'start_date.required' => 'Project start date is required',
            'start_date.date' => 'Project start date must be a valid date',
            'end_date.date' => 'Project end date must be a valid date',
            'end_date.after' => 'Project end date must be after the start date',
            'subtotal.required' => 'Project subtotal is required',
            'subtotal.numeric' => 'Project subtotal must be a number',
            'client_id.required' => 'Project client is required',
            'client_id.exists' => 'Project client must be a valid organization',
            'client_id.unique' => 'This client already has a project',
        ];        
    }

}
