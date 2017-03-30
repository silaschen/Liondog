<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cats".
 *
 * @property integer $id
 * @property string $cat_name
 */
class CatsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => 'Cat Name',
        ];
    }

    //get cate
    public static function getcates()
    {
        $cate["0"]="no cates";
        $list = self::find()->asArray()->all();
        foreach ($list as $key => $value) {
            
            $cate[$value['id']]=$value['cat_name'];
        }
        return $cate;


    }


    //test get one where id=$id
    public static function getone($id)
    {
        $model = CatsModel::findone($id);
        return $model;

    }
}
