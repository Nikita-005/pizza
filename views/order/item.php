<?php

use app\models\Status;
use yii\bootstrap5\Html;
?>

<div class="card" style="width: 26rem;">
  <div class="card-body">
    <h2 class="card-title">Заказ №<?= Html::encode($model->id) ?> от <?= Html::encode($model->created_at) ?></h2>
    <p class="card-text">Пицца: <?= Html::encode($model->product->name) ?></з>
    <p class="card-text">Дополнительные опции: <?= $model->option ? Html::encode($model->option->name) : Html::encode($model->custom_option) ?></p>
    <p class="card-text">Дата доставки: <?= Html::encode($model->delivery_date) ?></з>
    <p class="card-text">Время доставки: <?= Html::encode($model->delivery_time) ?></з>
    <p class="card-text">Адрес доставки: <?= Html::encode($model->address) ?></p>
    <p class="card-text">Телефон: <?= $model->phone ? Html::encode($model->phone) : Html::encode($model->user->phone) ?></p>
    <?php if($model->comment): ?>
      <p class="card-text">Комментарий: <?= Html::encode($model->comment) ?></p>
    <?php endif; ?>
    <p class="card-text">Статус заказа: <?= Html::encode($model->status->name) ?></p>
    <?php if($model->comment && $model->status_id == Status::searchId('name', 'Отменен') ): ?>
      <p class="card-text">Причина отмены: <?= Html::encode($model->comment_admin) ?></p>
    <?php endif; ?>

    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100']) ?>
  </div>
</div>