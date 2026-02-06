<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class   ModelActiveRecord extends ActiveRecord
{
    private static $ids = [];
    public static function searchId($field, $value){
        if(!isset(self::$ids[$field][$value])){
            static::$ids[$field][$value] = static::findOne([$field => $value])->id;
        }
        return self::$ids[$field][$value];
    }
    public static function getItemsList($column, $indexedById = true, $id = 'id')
    {
        $indexColumn = $indexedById ? $id : $column;
        return (new Query())->select($column)->from(self::tableName())->indexBy($indexColumn)->column();
    }


}