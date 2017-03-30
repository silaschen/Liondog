<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acfun".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $create_at
 */
class Acfun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acfun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'create_at'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 150],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'create_at' => 'Create At',
        ];
    }
}
