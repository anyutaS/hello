<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $img_name
 * @property string $url
 */
class Image extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['img_name'], 'string', 'max' => 35],
            [['img_name'], 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['description'], 'string'],
            [['userId'], 'integer'],
            [['description'], 'required'],
//            [['file'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_name' => 'Имя',

        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->file) {
                $img = time() . $this->file->baseName . '.' . $this->file->extension;
                $this->file->saveAs('photo/' . $img);
                $url = '/photo/' . $img;
                $desc = $this->description;
                $this->file = $img;
                $this->url = $url;
                $this->description = $desc;
                $this->save();
                return true;
            }
        }
    }

    public function afterDelete()
    {
        unlink(Yii::$app->basePath . '/web'. $this->url);
    }
}
