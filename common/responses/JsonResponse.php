<?php
namespace Phanbook\Responses;

use Phalcon\Http\Response;

class JsonResponse extends Response
{
    /**
     *
     *
     */
    public function __construct()
    {
        $this->setUp();
    }

    /**
     *
     * @return mixed
     */
    public function setUp()
    {
        return $this->setContentType('application/json', 'UTF-8')->sendHeaders();
    }
    public static function json($data = [], $status = 200, $headers = [], $options = 0)
    {
        echo json_encode($data);
    }
}
