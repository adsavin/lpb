<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Places');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => Yii::t('app', 'Logo'),
                'format' => 'html',
                'value' => function($data) {
                    return Html::img(Yii::$app->params['LOGOPATH'].$data->logo, ['style' => 'height: 50px;', 'class' => 'img']);
                }
            ],
            \app\models\District::getName(),
            Yii::$app->language == "la-LA" ? 'village_lao':'village_eng',
             [
                 'attribute' => 'district_id',
                 'label' => Yii::t('app', 'District'),
                 'value' => function($data) {
                    return $data->district[\app\models\District::getName()];
                 },
                 'filter' => \yii\helpers\ArrayHelper::map(\app\models\District::find()->all(), "id", \app\models\District::getName())
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
