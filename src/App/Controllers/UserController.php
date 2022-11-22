<?php

namespace UserAuth\App\Controllers;

use UserAuth\App\Models\User;
use UserAuth\Services\Database\DatabaseConnection;
use UserAuth\App\Requests\LoginRequest;

class UserController extends Controller
{
    public function login(): void
    {
        $request = new LoginRequest();
        $this->validateRequest($request);

        $params = $request->getParams();
        $user = (new User(new DatabaseConnection()))->select(['username' => $params['username']])->first();

        if ($user->exists() && $user->login($params['password'])) {
            echo $this->success($user->getAttributeS());

            return;
        }

        echo $this->success(['error' => 'Username or password incorrect']);
    }
}
