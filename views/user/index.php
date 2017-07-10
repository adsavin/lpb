<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'first_name',
            [
                'attribute' => 'last_name',
                'options' => [
                    'class' => 'hidden-sm hidden-xs'
                ]
            ],
             'phone_no',
             [
                 'attribute' => 'status',
                 'filter' => USER::$STATUS,
                 'format' => 'html',
                 'value' => function($data) {
                     switch ($data->status) {
                         case "Active":
                             return "<span class='label label-success'>Active</span>";
                         case "User":
                             return "<span class='label label-danger'>Inactive</span>";
                     }
                 }
             ],
            [
                'attribute' => 'role',
                'filter' => User::$ROLES,
                'format' => 'html',
                'value' => function($data) {
                    switch ($data->role) {
                        case "Admin":
                            return "<span class='label label-primary'>Admin</span>";
                        case "User":
                            return "<span class='label label-info'>User</span>";
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => [
                    'class' => 'btn btn-default'
                ],
                'options' => [
                        'style' => 'width: 15%'
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
