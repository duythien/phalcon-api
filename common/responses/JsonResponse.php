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
        $this->setContentType('application/json', 'UTF-8')->sendHeaders();
    }

}
