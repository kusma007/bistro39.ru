<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "content_menu".
 *
 * @property integer $id
 * @property string $status
 * @property string $content
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
            [['status', 'content'], 'required'],
            [['status', 'content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'content' => 'Content',
        ];
    }
}
