<?php

namespace app\models;

use Yii;
use app\models\Product;
use app\models\Status;
use app\models\Options;
use app\models\User;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $product_id
 * @property int $option_id
 * @property string $phone
 */
class Order extends ModelActiveRecord
{
    public $check = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }
    public const SCENARIO_CANCEL = 'cancel';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'phone', 'address', 'pay_type_id', 'name', 'delivery_date', 'delivery_time'], 'required'],
            [['product_id', 'pay_type_id'], 'integer'],
            ['delivery_date', 'date', 'format' => 'php:Y-m-d', 'min' => date('Y-m-d'), 'tooSmall' => 'Дата не должна быть раньше сегодняшней'],
            ['delivery_time', 'date', 'type' => \yii\validators\DateValidator::TYPE_TIME, 'format' => 'H:m', 'min' => '09:00', 'max' => '23:55','message' => 'Выберите время в промежутке от 09:00 до 23:55'],
            [['name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 255],
            [['custom_option'], 'string', 'max' => 255],
            ['comment_admin', 'required', 'on' => self::SCENARIO_CANCEL],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заказчик',
            'product_id' => 'Пицца',
            'option_id' => 'Дополнительная опция',
            'check' => 'Выбрать свою опцию',
            'custom_option' => 'Своя опция',
            'delivery_date' => 'Дата доставки',
            'delivery_time' => 'Время доставки',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'pay_type_id' => 'Тип оплаты',
            'comment' => 'Комментарий повару',
            'status_id' => 'Статус заказа',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getOption()
    {
        return $this->hasOne(Options::class, ['id' => 'option_id']);
    }
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
    public function getPayType()
    {
        return $this->hasOne(PayType::class, ['id' => 'pay_type_id']);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->user->id;
                $this->status_id = Status::searchId('name', 'Новый');
            }
            return true;
        }
        return false;
    }
    public function changeStatus($status_id, $messageSuccess = 'Статус успешно изменен', $attributeNames = ['status_id'] )
    {
        $this->status_id = $status_id;
        if($this->save(true, $attributeNames)){
            Yii::$app->session->setFlash('success', $messageSuccess);
        }
    }
}

