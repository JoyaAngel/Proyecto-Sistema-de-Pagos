<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
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
        $idOrganization = $this->route('organization')->idOrganization ?? null;

        return [
            'name' => 'required|string|max:100',
            'type' => '',
            'person' => 'required',
            'rfc' => 'required|string|max:13' . ($idOrganization ? '' : '|unique:organizations,rfc'),
            'email' => 'required|email|max:100' . ($idOrganization ? '' : '|unique:organizations,email'),
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:150',
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
            'name.required' => 'Organization name is required',
            'name.max' => 'Organization name must be 100 stringacters',
            'person.required' => 'Organization person is required',
            'rfc.required' => 'Organization RFC is required',
            'rfc.max' => 'Organization RFC must be 13 stringacters',
            'email.required' => 'Organization email is required',
            'email.email' => 'Organization email must be a valid email',
            'email.max' => 'Organization email must be 100 stringacters',
            'phone.required' => 'Organization phone is required',
            'phone.max' => 'Organization phone must be 10 stringacters',
            'address.required' => 'Organization address is required',
            'address.max' => 'Organization address must be 150 stringacters'
        ];
    }
}
