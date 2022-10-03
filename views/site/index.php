<?php
use app\models\Image;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'image',
                'label' => 'Картинка',
                'format' => 'raw',
                'options' => ['width' => '100'],
                'value' => function($d){
                    return "<img width='150' src='../files/".$d->title."'><br>
                    <a href='".Url::to(['site/view', 'id' => $d->id])."'>Оригинальный размер</a>";
                },
            ],
            'title',
            'date',
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>