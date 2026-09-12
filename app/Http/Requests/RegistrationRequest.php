<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\CommonTraits;
use App\Enums\{ StatusEnums, RulesEnums };

class RegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => RulesEnums::NAME_REQUIRED->value,
            'email.required' => RulesEnums::EMAIL_REQUIRED->value,
            'email.email' => RulesEnums::EMAIL_INVALID->value,
            'email.unique' => RulesEnums::EMAIL_UNIQUE->value,
            'password.required' => RulesEnums::PASSWORD_REQUIRED->value,
            'password.min' => RulesEnums::PASSWORD_MIN->value,
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->formatResponse(StatusEnums::ERROR, 
        StatusEnums::VALIDATION_FAILED, null, $validator->errors(), 422);
        
        throw new ValidationException($validator, $response);
    }
}