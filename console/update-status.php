<?php
use app\models\ContentMenu;

$model_on = ContentMenu::findOne(['status' => 'on']);
$model_on->status = 'off';
$id_off = $model_on->id+1;

$count_content = ContentMenu::find()->count();
if($id_off > $count_content) {$id_off = 1;}
$model =ContentMenu::findOne(['id' => $id_off]);
$model->status = 'on';

if($model->save() && $model_on->save()) {
    return true;
}