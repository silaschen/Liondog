<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }
     
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'browser' => 'Browser',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }


    #when reading the essay,update the data#
    public function updata($cond,$attr,$num)
    {
        $info = self::find()->where($cond)->one();

        //还没人阅读
        if (!$info) {

            $this->setAttributes($cond);
            $this->$attr = $num;
            $this->save();
    
        }else{
            $data[$attr] = $num;
            $info->updateCounters($data);
        }







    }
}
