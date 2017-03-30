<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\PostsModel;
use frontend\models\TagForm;
use common\models\RelationPostTags;
class PostForm extends Model
{
    /**
     * @inheritdoc

     */
    public $id;
    public $tags;
    public $title;
    public $content;
    public $summary;
    public $label_img;
    public $cat_id;
    public $last_error;
    

    const EVENT_AFTER = 'AfterEvent';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content','tags'], 'string'],

            [['cat_id'], 'integer'],
            [['title', 'summary', 'label_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            
            'tags'=>"tags",
            'title' => 'Title',
            'summary' => 'Summary',
            'content' => 'Content',
            'label_img' => 'Label Img',
            'cat_id' => 'Cat ID'
        
        ];
    }


    public function create()
    {
        //new transation

        $transaction = \yii::$app->db->beginTransaction();
        try {

            // $connection->createCommand($sql1)->execute();
            // ... executing other SQL statements ...
            $model = new PostsModel();
            $model->SetAttributes($this->attributes);
          

            $model->user_id = yii::$app->user->identity->id;
            $model->user_name = yii::$app->user->identity->username;
            $model->is_valid = PostsModel::VALID;
            $model->summary = mb_substr(strip_tags($this->content), 0,60,'utf-8');
            $model->created_at = time();
            $model->updated_at = time();

            if (!$model->save()) {
                throw new \Exception("Error Processing Request");
                
            }
            $this->id = $model->id;

            //after the post save,do things
            // $data = array_merge($this->getAttributes(),$model->getAttributes());
            $data = $this->getAttributes(); 
         
            $this->AfterEvent($data);


            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->last_error =$e->getMessage();
            return false;
        }

    }

    #EventAfter#
    public function AfterEvent($data)
    {
        $this->on(self::EVENT_AFTER,[$this,'TagAdd'],$data);
        $this->trigger(self::EVENT_AFTER);

    }

    #addtag#
    public function TagAdd($event)
    {
        $tag = new TagForm();
        $tag->tags = $event->data['tags'];
        $tagid = $tag->saveTag();


        //del the relation
        RelationPostTags::deleteAll(['post_id'=>$event->data['id']]);

        
        //save new
        foreach ($tagid as $key => $value) {
            
            $row[$key]['post_id'] = $this->id;
            $row[$key]['tag_id'] = $value;
        }

        
        $res = (new Query())->createCommand()->batchInsert(RelationPostTags::tableName(),['post_id','tag_id'],$row)->execute();
        if (!$res) {
            throw new \Exception("relation add failed");
            
        }



    }

    #find one#
    public function findPost($id)
    {
        $model = PostsModel::find()->with('relate.tag','extend')->where(['id'=>$id])->asArray()->one();
        
        foreach ($model['relate'] as $key => $value) {
            $model['tags'][] = $value['tag']['tag_name'];
        }
        unset($model['relate']);

        return $model;

    }


    #getList for widgetsPost#
    public static function getList($cond,$p,$pageSize = 2)
    {
        $model = new PostsModel();

        $list = $model->find()->where($cond)->with('relate.tag','extend','cate');
        // $res = $list->asArray()->all();
         $res = $model->getPage($list,$p,$pageSize);

         $res['data'] =self::formatlist($res['data']);
   
        return $res;

    }

    public static function formatlist($data){

        foreach ($data as $key => $value){
            
            // $value['tags'] = [];
            if (isset($value['relate'])) {
                    
                    foreach ($value['relate'] as $vo) {
                         $data[$key]['tags'][] = $vo['tag']['tag_name'];

                    }

                    
            } 
            unset($data[$key]['relate']);    


        }
            return $data;
    }


}
