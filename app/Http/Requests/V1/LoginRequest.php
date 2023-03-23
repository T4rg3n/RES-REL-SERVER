<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize()
    {
        //Only for development
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
            'mail' => ['required','email', 'max:255'],
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
}