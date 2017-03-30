<?php

namespace common\models;

use Yii;
use backend\models\RelationTagVideo;
use common\models\User;
use backend\models\TagForm;
use common\models\RelationVideoTags;
/**
 * This is the model class for table "video".
 *
 * @property string $id
 * @property string $name
 * @property string $desc
 * @property integer $uid
 * @property string $url
 * @property string $addtime
 * @property integer $cid
 * @property string $label_img
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     const EVENT_AFTER = 'AfterEvent';
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'cid'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['desc', 'url'], 'string', 'max' => 550],
            [['addtime'], 'integer'],
            [['label_img'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'uid' => 'Uid',
            'url' => 'Url',
            'addtime' => 'Addtime',
            'cid' => 'Cid',
            'label_img' => 'Label Img',
        ];
    }

    public function getTag(){

        return $this->hasMany(RelationTagVideo::className(),['video_id'=>'id']);
    }

    public function getCate(){

        return $this->hasOne(CatsModel::className(),['id'=>'cid']);
    }

    public function getUser(){

        return $this->hasOne(Admin::className(),['id'=>'uid']);
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



}
