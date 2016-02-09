<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$this->title = 'Онлайн заявка обеда - Быстро №1';
AppAsset::register($this);

$controller_action = Yii::$app->controller->route;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body <?php echo ($controller_action != 'site/index')? '':'style="overflow:hidden"'; ?>>
<?php $this->beginBody() ?>
    <?php if($controller_action != 'site/index') { ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Бистро №1',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Главная', 'url' => ['/']],
                    ['label' => 'Контент', 'url' => ['/content-menu/index']],
//                    ['label' => 'About', 'url' => ['/site/about']],
//                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Вход', 'url' => ['/site/login']] :
                        [
                            'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']
                        ],
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?php echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
    <?php } ?>
        <?php  echo $content ?>
    <?php if($controller_action != 'site/index') { ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; bistro39.ru <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
    <?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
