<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $data
 * @property string $idimage
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['data'], 'safe'],
            [['data'], 'default', 'value' => date('Y-n-d')],
            [['name'], 'string', 'max' => 15],
            [['name'], 'required'],
            [['idimage'], 'integer' ],

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
            'text' => 'Text',
            'data' => 'Data',
        ];
    }

}
