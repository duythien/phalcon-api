<?php
namespace App\Transformer;

use App\Models\Tests;
use League\Fractal\TransformerAbstract;

class TestsTransformer extends TransformerAbstract
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param Tests $test
     * @return array
     */
    public function transform(Tests $test)
    {

        $result = [];
        foreach ($test->column() as $key => $value) {
            if (isset($this->config['fields']) && !in_array($value, $this->config['fields'])) {
                continue;
            }
            $result[$value] =  $test->$key;
        }
        return $result;
    }
}
