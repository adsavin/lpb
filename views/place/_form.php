<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Place */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="well row">
    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>

    <div class="col-md-4 text-center">
        <div >
            <img class="img img-thumbnail" src="<?= isset($model->logo)? Yii::$app->params["LOGOPATH"].$model->logo:'' ?>" id="previewlogo" style="max-width: 80%" />
        </div>
        <button id="btnlogo" type="button" class="btn btn-primary"><i class="fa fa-camera"></i> <?= Yii::t('app', 'Logo') ?></button>
        <?= $form->field($model, 'logouploader')->fileInput(['accept' => 'image/*', 'class' => 'hidden'])->label(false) ?>
    </div>
    <div class="col-md-8">
        <div class="col-md-6">
            <?= $form->field($model, 'name_lao')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name_eng')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description_lao')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description_eng')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'village_lao')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'village_eng')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'district_id')
                ->dropDownList(
                    \yii\helpers\ArrayHelper::map(\app\models\District::find()->all(), "id"
                        , Yii::$app->language == "la-LA" ? "name_lao" : "name_eng"), [
                    'prompt' => ''
                ]) ?>
        </div>
    </div>
    <div class="col-md-12" id="map" style="height: 500px;width: 100%"></div>
    <div class="col-md-6">
        <?= $form->field($model, 'lat')->textInput() ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'lon')->textInput() ?>
    </div>

    <div class="col-md-4 col-md-offset-4">
        <?= $form->field($model, 'status')
            ->dropDownList(\app\models\Place::$STATUS, [
                    'prompt' => ''
            ]) ?>
    </div>
    <div class="col-md-12 text-center">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
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
        map.addListener('click', function(e) {
            marker.setPosition({lat: e.latLng.lat(), lng: e.latLng.lng()});
            marker.setMap(this);
            $("#place-lat").val(e.latLng.lat());
            $("#place-lon").val(e.latLng.lng());
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBshodpPyQhHr3qoJ9287qY8G4o7tZRDf8&callback=initMap">
</script>
<?php
$this->registerJs('
    $("#btnlogo").click(function() {
        $("#place-logouploader").click();
    });

    $("#place-logouploader").change(function () {
        previewImage(this, $("#previewlogo"));
    })
    function previewImage(input, $preview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $preview.attr(\'src\', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
');