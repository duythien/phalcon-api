<?php
namespace Phanbook\Responses;

use Phalcon\Http\Response;

class XmlResponse extends Response
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
        $this->setContentType('application/xml', 'UTF-8')->sendHeaders();
    }
}
