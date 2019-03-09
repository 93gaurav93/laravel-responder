<?php

namespace gaurav93d\LaravelResponder;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class LaravelResponder
 * @package gaurav93d\LaravelResponder
 */
class LaravelResponder
{
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var int
     */
    protected $status = 200;
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var bool
     */
    protected $success = true;
    /**
     * @var array
     */
    protected $errors = [];


    /**
     * @param array $headers
     * @return LaravelResponder
     */
    public function headers($headers = [])
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param array $data
     * @param int $status
     * @return mixed
     */
    public function success($data = [], $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
        return $this->respond();
    }

    /**
     * @param array $errors
     * @param int $status
     * @return mixed
     */
    public function errors($errors = [], $status = 200)
    {
        $this->errors = $errors;
        $this->status = $status;
        $this->success = false;
        return $this->respond();
    }

    /**
     * @return mixed
     */
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

    /**
     * @param string $message
     * @param int $status
     * @return mixed
     */
    public function error($message = 'Error!', $status = 200)
    {
        return $this->errors([$message], $status);
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    public function respondValidationErrors(Validator $validator)
    {
        return $this->errors($validator->errors(), IlluminateResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondUnauthorizedError($message = 'Unauthorized!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondBadRequestError($message = 'Bad Request!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFoundError($message = 'Not found!')
    {
        return $this->errors([$message], IlluminateResponse::HTTP_NOT_FOUND);
    }
}