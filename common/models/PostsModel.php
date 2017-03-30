<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class PostsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc

     */
  
    const VALID = 1;//Publised
    const NOT_VALID = 0;//NOT
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],

            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tags'=>"tags",
            'title' => 'Title',
            'summary' => 'Summary',
            'content' => 'Content',
            'label_img' => 'Label Img',
            'cat_id' => 'Cat ID',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'is_valid' => 'Is Valid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getRelate()
    {

        return $this->hasMany(RelationPostTags::className(),['post_id'=>'id']);
    }

      public function getExtend()
    {

        return $this->hasOne(PostExtends::className(),['post_id'=>'id'])->orderBy('browser DESC');
    }

         public function getCate()
    {

        return $this->hasOne(CatsModel::className(),['id'=>'cat_id']);
    }


     public function getPage($list,$p=1,$pageSize = 1,$search = null)
    {


            if ($search) {
              $list = $list->andFilerWhere($search);
            }
                 
             

             $data['count'] = $list->count();

             if (!$data['count']) {
                 return ['count'=>0,'p'=>$p,'pageSize'=>$pageSize,'start'=>0,'end'=>0,'data'=>[]];
             }

             $cp = (ceil($data['count']/$pageSize)<$p)?ceil($data['count']/$pageSize):$p;

             $data['p'] = $cp;

             $data['pageSize'] = $pageSize;
             $data['start'] = ($cp-1)*$pageSize+1;
             $data['end'] = (ceil($data['count']/$pageSize) == $p)?$data['count']:($cp-1)*$pageSize+$pageSize;

             $data['data'] = $list->offset(($cp-1)*$pageSize)->limit($pageSize)->asArray()->all() ;
             // $data['data'] = $list->limit($pageSize)->asArray()->all();

              return $data;
        
       

    }

  

}
