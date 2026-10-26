<?php

namespace App\Operations\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function find(int $id): ?User
    {
        return User::find($id);
    }
}