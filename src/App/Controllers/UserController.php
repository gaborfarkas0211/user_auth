<?php

namespace UserAuth\App\Controllers;

use UserAuth\App\Models\User;
use UserAuth\App\Requests\LoginRequest;

class UserController extends Controller
{
    public function login(): void
    {
        $request = new LoginRequest();
        $this->validateRequest($request);

        $params = $request->getParams();
        $user = User::findByUsername($params['username']);

        if ($user->exists() && $user->login($params['password'])) {
            echo $this->success($user->getAttributeS());

            return;
        }

        echo $this->badRequest( ['error' => 'Username or password incorrect']);
    }
}
