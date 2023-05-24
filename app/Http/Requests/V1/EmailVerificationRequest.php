<?php

namespace App\Http\Requests\V1;

use App\Models\Utilisateur;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    public function authorize()
    {
        $user = Utilisateur::findOrFail($this->route('id'));

        if (! hash_equals((string) $user->getKey(), (string) $this->route('id'))) {
            return false;
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [];
    }

    public function fulfill()
    {
        $user = Utilisateur::findOrFail($this->route('id'));

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            return true;
        }
    }
}
