<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 ">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <p class="text-center"><?= Yii::t('app','Please fill out the following fields to login') ?>:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'options' => [
                'class' => 'well'
            ],
            'fieldConfig' => [
                'template' => "{label}<div class=\"col-sm-12\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-sm-12 text-center'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')
            ->textInput([
                'autofocus' => true,
                'class' => 'form-control text-center',
                'placeholder' => Yii::t('app', 'Username')
            ])
        ?>

        <?= $form->field($model, 'password')
            ->passwordInput([
                'class' => 'form-control text-center',
                'placeholder' => Yii::t('app', 'Password')
            ]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-sm-12 text-center\">{input} {label}</div>\n<div class=\"col-sm-12\">{error}</div>",
        ]) ?>

            <div class="text-center">
                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
