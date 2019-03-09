<?php

namespace gaurav93d\LaravelResponder;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as IlluminateResponse;

class LaravelResponder
{
    protected $headers = [];
    protected $status = 200;
    protected $data = [];
    protected $success = true;
    protected $errors = [];

    public function headers($headers = [])
    {
        $this->headers = $headers;
        return $this;
    }

    public function success($data = [], $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
        return $this->respond();
    }

    public function errors($errors = [], $status = 200)
    {
        $this->errors = $errors;
        $this->status = $status;
        $this->success = false;
        return $this->respond();
    }

    public function respond()
    {
        $responseData = [
            'success' => $this->success,
            'status' => $this->status,
            'data' => $this->data,
            'errors' => $this->errors,
        ];
        return response()->json($responseData, $this->status, $this->headers);
    }

    public function error($message = 'Error!', $status = 200)
    {
        return $this->errors([$message], $status);
    }

    public function respondValidationErrors(Validator $validator)
    {
        return $this->errors($validator->errors(), IlluminateResponse::HTTP_BAD_REQUEST);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function respondUnauthorizedError($message = 'Unauthorized!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_UNAUTHORIZED);
    }

    public function respondBadRequestError($message = 'Bad Request!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_BAD_REQUEST);
    }

    public function respondNotFoundError($message = 'Not found!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_NOT_FOUND);
    }
}