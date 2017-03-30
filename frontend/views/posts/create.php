<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'write posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

               
                <?= $form->field($model,'cat_id')->dropDownList($cates)->label("category")?>

                    <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
        'config'=>[
            //图片上传的一些配置，不写调用默认配置
            
        ]
    ]) ?>

                <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
    'options'=>[
        'initialFrameWidth' => 850,
    ]
])  ?>

<?= $form->field($model,'tags')->widget('common\widgets\tags\TagWidget')?>


                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
