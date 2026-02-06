<?php
  use yii\bootstrap5\Html;
  use app\models\Status;
?>

<div class="card" style="width: 26rem;">
  <div class="card-body">
    <h2 class="card-title">Заказ №<?= Html::encode($model->id) ?> от <?= Html::encode($model->created_at) ?></h2>
    <p class="card-text">Заказчик: <?= Html::encode($model->name) ?></з>
    <p class="card-text">Пицца: <?= Html::encode($model->product->name) ?></з>
    <p class="card-text">Дополнительные опции: <?= $model->option ? Html::encode($model->option->name) : Html::encode($model->custom_option) ?></p>
    <p class="card-text">Дата доставки: <?= Html::encode($model->delivery_date) ?></з>
    <p class="card-text">Время доставки: <?= Html::encode($model->delivery_time) ?></з>
    <p class="card-text">Адрес доставки: <?= Html::encode($model->address) ?></p>
    <p class="card-text">Телефон: <?= $model->phone ? Html::encode($model->phone) : Html::encode($model->user->phone) ?></p>
    <p class="card-text">Статус заказа: <?= Html::encode($model->status->name) ?></p>
    <?php if($model->comment_admin): ?>
      <p class="card-text">Комментарий админа: <?= Html::encode($model->comment_admin) ?></p>
    <?php endif; ?>
    <?php if($model->comment): ?>
      <p class="card-text">Комментарий повару: <?= Html::encode($model->comment) ?></p>
    <?php endif; ?>

    <?= $model->status_id == Status::searchId('name', 'Новый') ? Html::a('В работу', ['submit', 'id' => $model->id], ['class' => 'btn btn-outline-success w-100']) : '' ?>
    <?= $model->status_id == Status::searchId('name', 'В работе') ? Html::a('Выполнен', ['ready', 'id' => $model->id], ['class' => 'btn btn-outline-success w-100']) : '' ?>
    <?= $model->status_id == Status::searchId('name', 'Новый') ||
      $model->status_id == Status::searchId('name', 'В работе')
      ? Html::a('Отменить', ['cancel', 'id' => $model->id], ['class' => 'btn btn-outline-danger w-100']) : '' ?>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100']) ?>
  </div>
</div>