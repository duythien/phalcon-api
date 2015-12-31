<?php

namespace Phanbook\Controllers;

use Phalcon\Mvc\Controller;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;

/**
 * Class ControllerBase
 *
 * @package Phanbook\Frontend\Controllers
 */
class ControllerBase extends Controller
{
    /**
     * @constant string name of api with the 400 client error
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     *
     */
    const CODE_WRONG_ARGS       = 'GEN-FUBARGS';

    /**
     * @constant string name of api with the 404 client error
     *
     */
    const CODE_NOT_FOUND        = 'GEN-LIKETHEWIND';

    /**
     * @constant string name of api with the 500 server error
     *
     */
    const CODE_INTERNAL_ERROR   = 'GEN-AAAGGH';

    /**
     * @constant string name of api with the 401 client error
     *
     */
    const CODE_UNAUTHORIZED     = 'GEN-MAYBGTFO';

    /**
     * @constant string name of api with the 403 client error
     *
     */
    const CODE_FORBIDDEN        = 'GEN-GTFO';

    /**
     *
     * @var integer
     */
    protected $statusCode = 200;

    /**
     * Getter for statusCode
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * [respondWithItem description]
     *
     * @param  [type] $item     [description]
     * @param  [type] $callback [description]
     * @return [type]           [description]
     */
    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }
    /**
     * [respondWithCollection description]
     * @param  [type] $collection [description]
     * @param  [type] $callback   [description]
     * @return [type]             [description]
     */
    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }
    /**
     * [respondWithArray description]
     * @param  array  $array   [description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        $response = Response::json($array, $this->statusCode, $headers);

        // $response->header('Content-Type', 'application/json');

        return $response;
    }

    /**
     * [respondWithError description]
     * @param  [type] $message   [description]
     * @param  [type] $errorCode [description]
     * @return [type]            [description]
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }

        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)->respondWithError($message, self::CODE_WRONG_ARGS);
    }
}
