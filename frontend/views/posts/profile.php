<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostsModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-model-form">

    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'avatar')->widget('common\widgets\file_upload\FileUpload',[
        'config'=>[
            //图片上传的一些配置，不写调用默认配置
            
        ]
    ]) ?>

  
                <div class="form-group">
                    <?= Html::submitButton('save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

    <?php ActiveForm::end(); ?>

</div>
