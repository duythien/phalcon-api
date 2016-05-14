<?php
namespace App\Responses;

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

    /**
     * @param array $data
     *
     */
    public  function json($data = [])
    {

        echo json_encode($data);
    }
}
