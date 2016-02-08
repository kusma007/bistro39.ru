<?php
use yii\web\View;

echo $model->content;

$this->registerJsFile('@web/js/main.js',['depends' => ['yii\web\YiiAsset'],'position'=>View::POS_END]);

?>

