<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>
            <a class="btn btn-lg btn-success" href="index.php?r=place/syncfirebase">
                <i class="fa fa-fire"></i>
                <?= Yii::t('app', 'Sync Firebase') ?>
            </a>
        </h1>
    </div>
</div>
