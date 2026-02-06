<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datatime".
 *
 * @property int $id
 * @property string|null $data
 * @property string|null $time
 */
class Datatime extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datatime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'time'], 'default', 'value' => null],
            [['data', 'time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'time' => 'Time',
        ];
    }

}
