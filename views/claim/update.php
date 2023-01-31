<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Claim $model */

$this->title = 'Update Claim: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Claims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_claim' => $model->id_claim]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="claim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
