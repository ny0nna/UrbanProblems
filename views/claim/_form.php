<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Claim $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="claim-form">

    <?php $form = ActiveForm::begin(); ?>

 

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_cat')->dropDownList([]) ?>
    
    <br>
    <?= $form->field($model, 'photo_before')->fileInput(['maxlength' => true]) ?>
<br>
    <?= $form->field($model, 'photo_after')->fileInput(['maxlength' => true]) ?>
<br>
    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'ststus')->dropDownList([ 'Новая' => 'Новая', 'Решена' => 'Решена', 'Отклонена' => 'Отклонена', ], ['prompt' => '']) ?>
<br>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
