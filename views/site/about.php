<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Claim;
use app\models\Category;
use yii\bootstrap5;
/** @var app\models\ClaimSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


//$this->params['breadcrumbs'][] = $this->title;
?>   
<p id="count">Счетчик обновится в ближайшие 3 секунды!</p>
<input type="button" value="Разрешаю!" class="btn btn-success">

<?php 

$claims=Claim::find()->where(['status'=>'Решена'])->orderBy(['time'=>SORT_DESC])->limit(4)->all();
echo "<div class='d-flex flex-row flex-wrap justify-content-start align-items-end'>";
foreach ($claims as $claim){
        echo "<div class='card m-1' style='width:22%; min-width: 300px; height:500px;'>
 <a href='/claim/index?id_claim={$claim->id_claim}'><img src='{$claim->photo_after}' 
 data-before='$claim->photo_before' data-after='$claim->photo_after'
 onMouseOver='hover(this)' onMouseOut='back(this)'
class='card-img-top' style='height: 300px; width: 300px;' alt='image'></a>
 <div class='card-body'>
 <h3 class='card-title'>{$claim->name}</h3>
 
 <p>{$claim->getCat()->One()->name}</p>
 <p><b>Время подачи заявки:</b> {$claim->time}</p>
 
</div> </div>";
}

?>
<script>
var i = 0;
function hover(el){

el.src=el.dataset.before;

}

function back(el){

el.src=el.dataset.after;

}


function updateCount(){
        $.ajax({
                type:'GET',
                url:'<?= Url::toRoute('/site/count')?>',
                dataType: 'text',
                success: function(response){
                        if(i!= response){
                                //SOUND!!!!!!
                                var audio = new Audio('../sound/notification.mp3'); 
                                audio.play();
                                i = response;

                        }
                         $('#count').html('Решено заявок: ' + response);
                }
});       
}

setInterval(updateCount,3000);
</script>