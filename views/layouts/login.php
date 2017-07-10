<?php
/* @var $this yii\web\View */

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;

$this->beginContent('@app/views/layouts/main.php');
?>

<?php
NavBar::begin([
    'brandLabel' => Yii::t('app', Yii::$app->params["appname"]),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ]
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => [
        ['label' => '<i class="fa fa-flag"></i> '. (Yii::$app->language == "en-US" ? "ລາວ" : "ENG")
            , 'url' => ['/site/changelang', 'l' => Yii::$app->language == "en-US"?"la":"en"]
            , 'options' => [
                'class' => 'btnchangelang'
            ]],
        ['label' => '<i class="fa fa-sign-in"></i> '. Yii::t('app', 'Login'), 'url' => ['/site/login']]
    ],
]);
NavBar::end();
?>

<div class="container">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
<script type="text/javascript" src="js/jquery.sha1.js"></script>
