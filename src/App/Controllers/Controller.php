<?php

namespace UserAuth\App\Controllers;

use UserAuth\App\Requests\RequestInterface;
use UserAuth\Exceptions\ValidationException;
use stdClass;

class Controller
{
    public function success(array|stdClass $data = []): string
    {
        header('HTTP/1.1 200 OK');

        return json_encode(['success' => true, 'data' => $data]);
    }

    public function notFound(): string
    {
        header('HTTP/1.1 404 Not Found');

        return json_encode(['success' => false, 'data' => []]);
    }

    protected function validateRequest(RequestInterface $request): void
    {
        try {
            $request->validate();
        } catch (ValidationException $e) {
            header('HTTP/1.1 422 Unprocessable Entity');

            echo json_encode(['success' => false, 'data' => ['error' => $request->getErrors()]]);
            die;
        }
    }
}
