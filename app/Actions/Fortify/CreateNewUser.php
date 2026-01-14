<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        // Validación de campos
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'first_surname' => ['required', 'string', 'max:255'],
            'middle_surname' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'type_document' => ['required', 'string', 'max:50'],
            'number_document' => ['required', 'string', 'max:50'],
            'number_phone' => ['required', 'string', 'max:20'],
        ])->validate();

        // Creación del usuario con el rol por defecto
        $user = User::create([
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'] ?? null,
            'first_surname' => $input['first_surname'],
            'middle_surname' => $input['middle_surname'] ?? null,
            'rol' => 'user_payer', 
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'type_document' => $input['type_document'],
            'number_document' => $input['number_document'],
            'number_phone' => $input['number_phone'],
        ]);

        // Asignar rol de Spatie
        $user->assignRole('user_payer');

        return $user;
    }
}
