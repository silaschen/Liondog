<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relation_post_tags".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $tag_id
 */
class RelationPostTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_post_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
            [['post_id', 'tag_id'], 'unique', 'targetAttribute' => ['post_id', 'tag_id'], 'message' => 'The combination of Post ID and Tag ID has already been taken.'],
        ];
    }

     public function getTag()
    {
      $tag = yii::$app->request->get("tag");

        return $this->hasOne(TagModel::className(),['id'=>'tag_id']);
    }

      public function getPost()
    {
        return $this->hasOne(PostsModel::className(),['id'=>'post_id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
