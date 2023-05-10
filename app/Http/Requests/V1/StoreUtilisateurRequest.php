<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StoreUtilisateurRequest extends FormRequest
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
            'mail' => ['required', 'string', 'email', 'max:255'],
            'motDePasse' => ['required', 'string', 'min:8', 'max:255'],
            'dateNaissance' => ['required', 'date'],
            'codePostal' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:255'],
            'photoProfil' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:5000'],
            //'exists:roles,id_role'
            //'role' => ['required', 'integer'],
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
            'mail.unique' => 'mail must be unique',
            'motDePasse.required' => 'motDePasse is required',
            'motDePasse.string' => 'motDePasse must be a string',
            'motDePasse.min' => 'motDePasse must be at least 8 characters',
            'motDePasse.max' => 'motDePasse must not be greater than 255 characters',
            'dateNaissance.required' => 'dateNaissance is required',
            'dateNaissance.date' => 'dateNaissance must be a valid date',
            'codePostal.required' => 'codePostal is required',
            'codePostal.string' => 'codePostal must be a string',
            'codePostal.max' => 'codePostal must not be greater than 255 characters',
            'nom.required' => 'nom is required',
            'nom.string' => 'nom must be a string',
            'nom.max' => 'nom must not be greater than 255 characters',
            'prenom.required' => 'prenom is required',
            'prenom.string' => 'prenom must be a string',
            'prenom.max' => 'prenom must not be greater than 255 characters',
            'bio.string' => 'bio must be a string',
            'bio.max' => 'bio must not be greater than 255 characters',
            'photoProfil.file' => 'photoProfil must be a file',
            'photoProfil.mimes' => 'photoProfil must be a file of type: png, jpg, jpeg',
            'photoProfil.max' => 'photoProfil must not be greater than 5000 kilobytes',
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
            'mdp_uti' => Hash::make($this->motDePasse),
            'date_naissance_uti' => $this->dateNaissance,
            'code_postal_uti' => $this->codePostal,
            'nom_uti' => $this->nom,
            'prenom_uti' => $this->prenom,
            'bio_uti' => $this->bio,
            //1 = super-admin, 2 = admin, 3 = moderateur, 4 = utilisateur
            'fk_id_role' => 4,
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
            'errors' => $validator->errors(),
        ], 422));
    }
}
