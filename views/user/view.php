<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'first_name',
            'last_name',
            'phone_no',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {
                    switch($data->status) {
                        case "Active":
                            return "<span class='label label-success'>Active</i>";
                        case "Inactive":
                            return "<span class='label label-danger'>Inctive</i>";
                        default:
                            return "-";
                    }
                }
            ],
            [
                'attribute' => 'role',
                'format' => 'html',
                'value' => function($data) {
                    switch($data->role) {
                        case "Admin":
                            return "<span class='label label-primary'>Admin</i>";
                        case "User":
                            return "<span class='label label-default'>User</i>";
                        default:
                            return "-";
                    }
                }
            ],
        ],
    ]) ?>

</div>
