<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClaimSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="claim-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_claim') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'discr') ?>

    <?= $form->field($model, 'id_cat') ?>

    <?php // echo $form->field($model, 'photo_after') ?>

    <?php // echo $form->field($model, 'photo_before') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'ststus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
