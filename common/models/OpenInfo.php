<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "open_info".
 *
 * @property integer $id
 * @property string $open_id
 * @property integer $user_id
 * @property string $nickname
 * @property integer $type
 * @property string $create_time
 */
class OpenInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'open_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            [['user_id', 'type', 'create_time'], 'integer'],
            [['open_id'], 'string', 'max' => 64],
            [['nickname'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'open_id' => 'Open ID',
            'user_id' => 'User ID',
            'nickname' => 'Nickname',
            'type' => 'Type',
            'create_time' => 'Create Time',
        ];
    }
}
