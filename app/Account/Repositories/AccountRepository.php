<?php

namespace App\Account\Repositories;

use App\Account\Contracts\AccountInterface;
use Illuminate\Auth\AuthManager;

class AccountRepository implements AccountInterface
{

    /**
     * @var AuthManager
     */
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function user()
    {
       return $this->auth->user();
    }
}