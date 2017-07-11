
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Place */

$this->title = Yii::t('app', $model[\app\models\District::getName()]. '\'s Photo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[\app\models\District::getName()], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <?php foreach ($model->photos as $photo): ?>
            <div class="col-lg-3 col-md-4">
                <img class="img " src="<?= Yii::$app->params['LOGOPATH'].$photo ?>" />
                <button class="btn btn-danger" type="button"><i class="fa fa-remove"></i> </button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <button id="btnaddphoto" class="btn btn-info" type="button"><i class="fa fa-plus-square"></i> <?= Yii::t('app', 'Add Photos') ?></button>
            </div>
        </div>
    </div>
    <hr />
    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>
    <div class="well row" id="newphoto">

    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs('
    var id = 0; 
    $("#btnaddphoto").click(function() {
        id++; 
        $container = new $("<div>");
        $container.addClass("col-lg-3")
            .addClass("col-md-4")
            .data("id", id)
            .css("height", "200px")
        ;
        
        $input = new $("<input>");
        $input.attr("type", "file")
            .attr("name", "Place[photoupload]["+id+"]")
            .addClass("form-control")
            .addClass("hidden")
        ;
        $preview = $("<img>");
        $preview.addClass("img")
            .data("id", id)
        ;                
               
        $container.append($input)
            .append($preview)            
        ;
        $("#newphoto").append($container);
        $input.click();
        $input.change(function() {
            previewImage($input, $preview);
            $btnremove = new $("<button>");
            $btnremove.addClass("btn")
                .addClass("btn-danger")
                .data("id", id)
                .append("<i class=\"fa fa-remove\"></i>")
            ;
            $btnremove.click(function() {
                $container.remove();
            });
            $container.append($btnremove);
        });
    });

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