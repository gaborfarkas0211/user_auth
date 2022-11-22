<?php

namespace UserAuth\App\Requests;

class LoginRequest extends AbstractRequest implements RequestInterface
{
    public function rules(): array
    {
        return [
            'username' => ['string', 'required'],
            'password' => ['string', 'required'],
        ];
    }
}
