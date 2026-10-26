<?php

namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function checkIfAutorizedUser(int $id);
}