<?php

namespace backend\models;

use Yii;
use backend\models\RelationTagVideo;
/**
 * This is the model class for table "tags_video".
 *
 * @property integer $id
 * @property string $tag_name
 * @property integer $video_num
 */
class TagVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_num'], 'integer'],
            [['tag_name'], 'string', 'max' => 255],
            [['tag_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Tag Name',
            'video_num' => 'Video Num',
        ];
    }

 

}
