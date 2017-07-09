<?php
/* @var $this yii\web\View */

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->beginContent('@app/views/layouts/main.php');
?>

<?php
NavBar::begin([
    'brandLabel' => Yii::t('app', Yii::$app->params["appname"]),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        ['label' => Yii::t('app', 'Place'), 'url' => ['/place/index'],
            'options' => ['class' => '']
        ],
        ['label' => Yii::t('app', 'District'), 'url' => ['/district/index']],
        ['label' => Yii::t('app', 'User'), 'url' => ['/user/index']]
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => Yii::t('app', 'Change Password'), 'url' => ['/site/index']],
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
    ],
]);
NavBar::end();
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
