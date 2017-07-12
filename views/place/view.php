<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Place */

$this->title = $model[\app\models\District::getName()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Photo'), ['updatephoto', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-sm-4">
            <?= Html::img(Yii::$app->params["LOGOPATH"].$model->logo, ["class" => "img img-thumbnail", 'style' => 'height: 400px']) ?>
        </div>
        <div class="col-sm-8">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    Yii::$app->language == "la-LA"?'name_lao':'name_eng',
                    Yii::$app->language == "la-LA"?'village_lao':'village_eng',
                    [
                        'attribute' => Yii::$app->language == "la-LA"?'description_lao':'description_eng',
                        'format' => 'html',
                    ],
                    [
                        'label' => Yii::t("app", "District"),
                        'format' => 'html',
                        'value' => function($data) {
                            return Html::a($data->district[\app\models\District::getName()], ["district/view", "id" => $data->district_id]);
                        }
                    ],
                    [
                        'label' => Yii::t("app", "Last Update"),
                        'format' => 'html',
                        'value' => function($data) {
                            return Html::a($data->user->username, ["user/view", "id" => $data->user_id]) . " - ".date("d/m/Y H:i:s",strtotime($data->last_update));
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function($data) {
                            switch ($data->status) {
                                case "Show":
                                    return "<span class='label label-success'>".Yii::t('app',$data->status)."</span>";
                                case "Draft":
                                    return "<span class='label label-warning'>".Yii::t('app',$data->status)."</span>";
                                case "Deleted":
                                    return "<span class='label label-danger'>".Yii::t('app',$data->status)."</span>";
                                default:
                                    return "-";
                            }
                        }
                    ]
                ],
            ]) ?>
        </div>
        <div class="row">
            <?php foreach ($model->photos as $photo): ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <img class="img img-thumbnail" src="<?= Yii::$app->params['PHOTOPATH'].$photo->filename ?>" />
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-12" id="map" style="height: 400px;">

        </div>
    </div>

</div>

<script type="text/javascript">
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      mapTypeId: "hybrid",
      zoom: 13
    });
    var marker = new google.maps.Marker();
      <?php if(isset($model->lat) && isset($model->lon)): ?>
    var myLatlng = {lat: <?= $model->lat ?>, lng: <?= $model->lon ?>};
    marker.setPosition(myLatlng);
    marker.setMap(map);
      <?php else: ?>
    var myLatlng = {lat: 19.884266067849776, lng: 102.13431358337402};
      <?php endif; ?>
    map.setCenter(myLatlng);
  }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBshodpPyQhHr3qoJ9287qY8G4o7tZRDf8&callback=initMap">
</script>