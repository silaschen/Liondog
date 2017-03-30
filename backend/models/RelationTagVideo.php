<?php

namespace backend\models;

use Yii;
use backend\models\TagVideo;

/**
 * This is the model class for table "relation_video_tags".
 *
 * @property integer $id
 * @property integer $video_id
 * @property integer $tag_id
 */
class RelationTagVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_video_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'tag_id'], 'integer'],
            [['video_id', 'tag_id'], 'unique', 'targetAttribute' => ['video_id', 'tag_id'], 'message' => 'The combination of Video ID and Tag ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'tag_id' => 'Tag ID',
        ];
    }

       public function getVideo()
    {

        return $this->hasOne(TagVideo::className(),['id'=>'tag_id']);
    }
}
