<?php

namespace App\Operations\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{

    public function __construct(protected UserRepositoryInterface $userRepository) {}

    public function checkIfAutorizedUser(int $id)
    {
        if ($id == Auth::user()->id) {
            return true;
        }
        return abort(404);
    }
}