<?php

use App\Account\Contracts\AccountInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use Illuminate\Auth\AuthManager;

class AccountApiController extends controller
{
    /**
     * @var AccountInterface
     */
    private $account;

    public function __construct(AccountInterface $account)
    {
        $this->account = $account;
    }

    public function account()
    {
        return response(new AccountResource($this->account));
    }
}