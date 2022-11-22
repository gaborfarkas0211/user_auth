<?php

namespace UserAuth\App\Controllers;

use UserAuth\App\Enums\StatusCodeEnum;
use UserAuth\App\Requests\RequestInterface;
use UserAuth\Exceptions\ValidationException;
use stdClass;

class Controller
{
    public function success(array|stdClass $data = []): string
    {
        return $this->response(StatusCodeEnum::OK, $data);
    }

    public function badRequest(array|stdClass $data = []): string
    {
        return $this->response(StatusCodeEnum::BAD_REQUEST, $data);
    }

    public function response(StatusCodeEnum $statusCode, array|stdClass $data = []): string
    {
        header('HTTP/1.1 ' . $statusCode->value . ' ' . $statusCode->getMessage());

        return json_encode(['success' => $statusCode->isSuccess(), 'data' => $data]);
    }

    protected function validateRequest(RequestInterface $request): void
    {
        try {
            $request->validate();
        } catch (ValidationException $e) {
            echo $this->response(StatusCodeEnum::UNPROCESSABLE_ENTITY, $request->getErrors());
            die;
        }
    }
}
