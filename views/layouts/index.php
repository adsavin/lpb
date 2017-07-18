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
    'encodeLabels' => false,
    'items' => [
        ['label' => '<i class="fa fa-picture-o"></i> '. Yii::t('app', 'Place'), 'url' => ['/place/index'],
            'options' => ['class' => '']
        ],
        ['label' => '<i class="fa fa-th-list"></i> '. Yii::t('app', 'District'), 'url' => ['/district/index']],
        [
            'label' => '<i class="fa fa-user"></i> '. Yii::t('app', 'User'),
            'url' => ['/user/index']
        ],
        [
            'label' => '<i class="fa fa-language"></i> '. Yii::t('app', 'Translation'),
            'url' => ['/source-message/index']
        ]
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => [
        ['label' => '<i class="fa fa-flag"></i> '. (Yii::$app->language == "en-US" ? "ລາວ" : "ENG")
            , 'url' => ['/site/changelang', 'l' => Yii::$app->language == "en-US"?"la":"en"]
            , 'options' => [
                    'class' => 'btnchangelang'
            ]
        ],
        ['label' => '<i class="fa fa-key"></i> '. Yii::t('app', 'Change Password'), 'url' => ['/user/changepassword']],
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            '<i class="fa fa-sign-out"></i> '. Yii::t('app', 'Logout') .' (' . Yii::$app->user->identity->username . ')',
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

    <?php if(count(Yii::$app->session->getAllFlashes()) > 0): ?>
        <div class="row">
            <div class="col-sm-12">
        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $flash): ?>
            <div class="alert alert-<?= $key ?>"><?= $flash ?></div>
        <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?= $content ?>
</div>
<?php $this->endContent();