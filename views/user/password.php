<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="well">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'oldpassword')
                    ->passwordInput(['maxlength' => true])
                    ->label(Yii::t('app', 'Current Password'))
                ?>
                <?= $form->field($model, 'newpassword')
                    ->passwordInput(['maxlength' => true])
                    ->label(Yii::t('app', 'New Password'))
                ?>
                <?= $form->field($model, 'confirmpassword')
                    ->passwordInput(['maxlength' => true])
                    ->label(Yii::t('app', 'Confirm Password'))
                ?>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>