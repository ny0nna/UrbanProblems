<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Claim $model */

$this->title = 'Создание заявки';
$this->params['breadcrumbs'][] = ['label' => 'Заявки'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
