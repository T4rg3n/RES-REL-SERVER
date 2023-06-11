<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Everyone can login
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mail' => ['required','email', 'max:255', 'exists:utilisateurs,mail_uti'],
            'motDePasse' => ['required', 'string', 'min:8', 'max:255']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'mail.exists' => 'user not found',
            'mail.required' => 'mail is required',
            'mail.string' => 'mail must be a string',
            'mail.email' => 'mail must be a valid email address',
            'mail.max' => 'mail must not be greater than 255 characters',
            'motDePasse.required' => 'motDePasse is required',
            'motDePasse.string' => 'motDePasse must be a string',
            'motDePasse.min' => 'motDePasse must be at least 8 characters',
            'motDePasse.max' => 'motDePasse must not be greater than 255 characters',
        ];
    }

    /**
     * Translate request parameters to database columns
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'mail_uti' => $this->mail,
            'mdp_uti' => Hash::make($this->motDePasse)
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()
        ], 422));
    }
}
