<?php
namespace Phanbook\Responses;

use Phalcon\Http\Response;

class CsvResponse extends Response
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
        $this->setContentType('application/csv', 'UTF-8')->sendHeaders();
    }
}
