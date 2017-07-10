<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="stylesheet" href="css/font-awesome.css" />
    <style>
        .btnchangelang {
            font-family: "Noto Sans Lao", "Noto Serif Lao"
            , "Noto Sans Southeast Asian", "Noto Serif Southeast Asian"
            , "Saysettha OT", "Phetsarath OT"
            , "Helvetica Neue", Helvetica, Arial
            , sans-serif !important;
        }
        <?php if(Yii::$app->language == "la-LA"): ?>
        body {
            font-family: "Noto Sans Lao", "Noto Serif Lao"
            , "Noto Sans Southeast Asian", "Noto Serif Southeast Asian"
            , "Saysettha OT", "Phetsarath OT"
            , "Helvetica Neue", Helvetica, Arial
            , sans-serif !important;
        }
        <?php endif; ?>
    </style>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                &copy; <?= Yii::$app->params['appname'] ?> <?= date('Y') ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
