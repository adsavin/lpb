<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Translation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a("<i class='fa fa-plus'></i> ".Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'category',
            'message:ntext',
            [
                'label' => Yii::t('app', 'Translation'),
                'value' => function($data) {
                    if(isset($data->messages[0]))
                        return $data->messages[0]->translation;
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
<?php Pjax::end(); ?>
</div>
