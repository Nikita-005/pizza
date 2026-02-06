<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= 'Заказ № ' . Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Отменить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите отменить заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'product_id',
                'value' => $model->product->name,
            ],
            [
                'attribute' => 'option_id',
                'value' => $model->option->name ?? $model->custom_option,
            ],
            'delivery_date',
            'delivery_time',
            'phone',
            'address',
            [
                'attribute' => 'status_id',
                'value' => $model->status->name,
            ],
            [
                'attribute' => 'comment',
                'value' => $model->comment,
                'visible' => $model->comment != null,
            ],
        ],
    ]) ?>

</div>
