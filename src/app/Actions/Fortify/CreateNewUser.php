<?php

namespace App\Actions\Fortify;


use  App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class CreateNewUser  implements CreatesNewUsers
{

  public function create(array $input): User {

    $rules = [

      'name' => ['required', 'string', 'max:255'],
      'email'=> ['required','string', 'email', 'max:255','unique:users'],
      'password' => ['required', 'confirmed']
    ];

    Validator::make($input,$rules)->validate();

    return User::create([

      'name' => $input['name'],
      'email' => $input['email'],
      'password' => Hash::make($input['password']),

    ]);

    // 3) 作成した User を return



  }
}



