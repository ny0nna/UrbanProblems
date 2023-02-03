<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Claim $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="claim-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id_claim' => $model->id_claim], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id_claim' => $model->id_claim], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_claim',
            //'id_user',
            'name',
            'discr',
            ['attribute'=>'Категория', 'value'=> function($data){return
                $data->getCat()->One()->name;}],
                ['attribute'=>'Фото (до)', 'format'=>'html',
                'value'=>function($data){return" <img src='{$data->photo_before}' alt=''
                style='width: 70px;'>";}],
                
                ['attribute'=>'Фото (после)', 'format'=>'html',
                            'value'=>function($data){return" <img src='{$data->photo_after}' alt=''
                            style='width: 70px;'>";}],
            'time',
            'status',
        ],
    ]) ?>

</div>
