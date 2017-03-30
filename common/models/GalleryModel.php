<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $img
 * @property string $user_name
 * @property string $addtime
 */
class GalleryModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img', 'user_name', 'addtime'], 'required'],
            [['img'], 'string', 'max' => 250],
            [['user_name'], 'string', 'max' => 50],
            // [['addtime'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'user_name' => 'User Name',
            'addtime' => 'Addtime',
        ];
    }
}
