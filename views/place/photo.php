
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
    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>
    <div class="page-header">
        <h1><small><?= Yii::t('app', 'Add New Photos') ?></small></h1>
    </div>
    <div class="well row" id="newphoto">
        <?php for($i=0; $i<4; $i++): ?>
            <div class="col-lg-3 col-md-4">
                <button type="button" class="btn btn-info btnaddphoto col-xs-12" data-id="<?= $i ?>" >
                    <i class="fa fa-camera"></i> </button>
                <img class="img" style="width: 100%" id="preview-<?= $i ?>" />
                <?= $form->field($model, "photouploader[$i]")
                    ->fileInput(['class' => 'hidden', 'id' => "btn-$i", "data-id" => $i])
                    ->label(false); ?>
            </div>
        <?php endfor; ?>
    </div>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-primary col-xs-12"><?= Yii::t("app", "Save") ?> </button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="page-header">
        <h1><small><?= Yii::t('app', 'Current Photos') ?></small></h1>
    </div>
    <div class="row">
        <?php foreach ($model->photos as $photo): ?>
            <div class="col-lg-3 col-md-4 text-center photo" data-id="<?= $photo->id ?>">
                <img class="img " style="width: 100%" src="<?= Yii::$app->params['PHOTOPATH'].$photo->filename ?>" />
                <button class="btn btn-danger btnremove" data-id="<?= $photo->id ?>" type="button"><i class="fa fa-remove"></i> </button>
            </div>
        <?php endforeach; ?>
    </div>
    <hr />
</div>

<?php
$this->registerJs('     
    $(".btnaddphoto").click(function() {
        $("#btn-"+$(this).data("id")).click();
    });
    
    $("input.hidden").change(function() {
        previewImage(this, $("#preview-"+$(this).data("id")));
    });
    
    $(".btnremove").click(function() {
        $.post("index.php?r=place/removephoto", {id: $(this).data("id")}, function(data) {
            $(".photo[data-id="+data+"]").remove();
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