<?php
/**
 * Created by PhpStorm.
 * User: wangjin
 * Date: 2019-01-06
 * Time: 13:31
 */

namespace app\models;

use Pheasant\Types;
class Todo extends BaseModel
{
    public function properties()
    {
        return array(
            'id'   => new Types\SequenceType(),
            'title'    => new Types\StringType(255, 'required'),
            'status'   => new Types\BooleanType(),
        );
    }
}