<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Image $model */
/** @var ActiveForm $form */
?>
<div class="site-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'image[]')->fileInput(['multiple' => true]) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-add -->
