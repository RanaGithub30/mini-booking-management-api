<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\CommonTraits;
use App\Enums\{StatusEnums, RulesEnums};

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
    */
    public function messages() : array
    {
        return [
            'email.required' => RulesEnums::EMAIL_REQUIRED->value,
            'password.required' => RulesEnums::PASSWORD_REQUIRED->value,
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->formatResponse(StatusEnums::ERROR, 
        StatusEnums::VALIDATION_FAILED, null, $validator->errors(), 422);
        
        throw new ValidationException($validator, $response);
    }
}