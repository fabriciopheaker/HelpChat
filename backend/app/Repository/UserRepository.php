<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{

  public function createUser($params): bool
  {
    $user = User::create([
      'name' => $params->NOME,
      'email' => $params->EMAIL,
      'password' => bcrypt($params->PASSWORD),
    ]);
    return $user ? true : false;
  }
}
