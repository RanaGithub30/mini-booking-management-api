<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Enums\StatusEnums;
use App\Traits\CommonTraits;

class UserUpdateRequest extends FormRequest
{
    use CommonTraits;
    
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => StatusEnums::NAME_REQUIRED->value,
            'name.string' => StatusEnums::NAME_STRING->value,
            'name.max' => StatusEnums::NAME_MAX->value,
            'email.required' => StatusEnums::EMAIL_REQUIRED->value,
            'email.email' => StatusEnums::EMAIL_EMAIL->value,
            'email.max' => StatusEnums::EMAIL_MAX->value,
            'password.string' => StatusEnums::PASSWORD_STRING->value,
            'password.min' => StatusEnums::PASSWORD_MIN->value,
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->formatResponse(StatusEnums::ERROR, 
        StatusEnums::VALIDATION_FAILED, null, $validator->errors(), 422);
        
        throw new ValidationException($validator, $response);
    }
}