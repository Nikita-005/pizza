<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\YiiAsset;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin([
        // 'enableClientValidation' => false,
    ] ); ?>

    <?= $form->field($model, 'name' )->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->name]) ?>
    <?= $form->field($model, 'product_id')->dropDownList($products, ['prompt' => 'Выберите пиццу']) ?>

    <?= $form->field($model, 'option_id')->dropDownList($options, ['prompt' => 'Выберите дополнительную опцию']) ?>
    <?= $form->field($model, 'check')->checkbox(['id' => 'check']) ?>
    <div id="custom-option" class="d-none">
        <?= $form->field($model, 'custom_option')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'delivery_date')->input('date', ['min' => date('Y-m-d'), 'value' => date('Y-m-d')]) ?>
    <?= $form->field($model, 'delivery_time')->input('time', ['min' => '09:00', 'max' => '23:55']) ?>

    <?= $form->field($model, 'pay_type_id')->dropDownList($payTypes, ['prompt' => 'Выберите тип оплаты']) ?>
    <?= $form->field($model, 'phone' )->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->phone]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    let checkCustomOption = document.getElementById('check');
    let customOption = document.getElementById('custom-option');
    checkCustomOption.addEventListener('click', function(){
        if(this.checked){
            customOption.classList.remove('d-none');
        }else{
            customOption.classList.add('d-none');
        }
    } );
</script>



<?php
    // $this->registerJsFile('/js/check.js', ['depends' => YiiAsset::class]);
?>