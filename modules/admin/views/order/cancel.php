<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1><?= Html::encode($this->title) ?>Заказ №<?= $model->id  ?> - отмена</h1>
<p>
    <?= Html::a('Назад', ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
</p>



<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'comment_admin')->textarea(['rows' => 6])->label("Причина отмены") ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>