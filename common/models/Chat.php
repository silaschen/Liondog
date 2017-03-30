<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property string $id
 * @property integer $addtime
 * @property string $content
 * @property string $uid
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addtime', 'uid'], 'integer'],
            [['content'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'addtime' => 'Addtime',
            'content' => 'Content',
            'uid' => 'Uid',
        ];
    }

    //联合查询uesr
   public function getUser(){

    return $this->hasOne(User::className(),['id'=>'uid']);

   }
}
