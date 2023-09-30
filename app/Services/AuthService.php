<?php

namespace App\Services;

use App\Contracts\Service;
use App\Types\Identity;

class AuthService extends Service
{

    private Identity $identity;

    private string $password;


    public function setIdentity(string $identity): self
    {
        $this->identity = new Identity($identity);

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function auth()
    {

    }

}
