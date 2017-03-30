<?php 
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\Video;
use backend\models\TagForm;
use common\models\RelationVideoTags;
class VideoForm extends Model
{
    /**
     * @inheritdoc

     */
    public $id;
    public $tags;
    public $url;
    public $name;
    public $desc;
    public $label_img;
    public $cid;
    public $last_error;
    

    const EVENT_AFTER = 'AfterEvent';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc','tags','url'], 'string'],
            [['cid'], 'integer'],
            [['desc', 'name', 'label_img'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tags'=>"tags",
            'desc' => 'desc',
            'name' => 'name',
            'label_img' => 'Label Img',
            'cid' => 'CatID',
            'url'=>'url',
        ];
    }

    public function create()
    {
        //new transation

        $transaction = \yii::$app->db->beginTransaction();
        try {
            // $connection->createCommand($sql1)->execute();
            // ... executing other SQL statements ...
            $model = new Video();
            $model->SetAttributes($this->attributes);
            $model->uid = yii::$app->user->identity->id;
            $model->addtime = time();
            if (!$model->save()) {

                var_dump($model);
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
        RelationTagVideo::deleteAll(['video_id'=>$event->data['id']]);

        $row = array();
        //save new
        foreach ($tagid as $key => $value) {
            
            $row[$key]['video_id'] = $this->id;
            $row[$key]['tag_id'] = $value;
        }

        
        $res = (new Query())->createCommand()->batchInsert(RelationTagVideo::tableName(),['video_id','tag_id'],$row)->execute();
        if (!$res) {
            throw new \Exception("relation add failed");
            
        }
    }

    

     public function findModel($id)
    {
        if (($model = Video::find()->joinWith('tag.video')->where(['video.id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}


 ?>