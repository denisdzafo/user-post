<?php

namespace App\Http\Repository;

use App\Models\User;

class UserRepository 
{
    public function registerUser($name, $email, $password)
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);

        return $user->save();
    }

    public function getUserIdByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user->id;
    }
}
