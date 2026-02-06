<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
?>

<h1>Регистрация пользователя</h1>
<div class="col-md-5">
<?php $form = ActiveForm::begin([
                'id' => 'register-form',
                // 'enableClientValidation' => false,
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'login')->textInput() ?>
            <?= $form->field($model, 'email')->input('email') ?>
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '+7(999)-999-99-99']) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'birth')->input('date', ['max' => '2006-01-01']) ?>
            <?= $form->field($model, 'check')->checkbox() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

</div>