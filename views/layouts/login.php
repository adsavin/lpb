<?php
/* @var $this yii\web\View */

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;

$this->beginContent('@app/views/layouts/main.php');
?>

<?php
NavBar::begin([
    'brandLabel' => Yii::t('app', 'Luangprabang'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ]
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Login', 'url' => ['/site/login']]
    ],
]);
NavBar::end();
?>

<div class="container">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
