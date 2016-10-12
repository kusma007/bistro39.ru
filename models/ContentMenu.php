<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "content_menu".
 *
 * @property integer $id
 * @property string $status
 * @property string $content
 * @property string $date_update
 */
class ContentMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['status', 'content'], 'string'],
            [['date_update'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'content' => 'Контент',
            'date_update' => 'Дата',
        ];
    }
}
