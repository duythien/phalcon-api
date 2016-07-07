<?php
namespace App\Models;

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Model;

/**
 * Class ModelBase
 */
class ModelBase extends Model
{
    public static function getBuilder()
    {
        $di = FactoryDefault::getDefault();

        return $di->get('modelsManager')->createBuilder();
    }

    public static function modelQuery($query)
    {
        $builder = self::getBuilder();

        if (!empty($query['model'])) {
            $builder->from(['a' => 'FoxOMS\\Models\\' . $query['model']]);
        }

        if (!empty($query['columns'])) {
            $builder->columns($query['columns']);
        }
        if (!empty($query['joins'])) {
            foreach ($query['joins'] as $join) {
                if (in_array($join['type'], ['innerJoin', 'leftJoin', 'rightJoin', 'join'])) {
                    $builder->$join['type']($join['model'], $join['on'], $join['alias']);
                }
            }
        }
        if (!empty($query['groupBy'])) {
            $builder->groupBy($query['groupBy']);
        }
        if (!empty($query['orderBy'])) {
            $builder->orderBy($query['orderBy']);
        }
        if (!empty($query['where'])) {
            $builder->where($query['where']);
        }
        return $builder;
    }
}
