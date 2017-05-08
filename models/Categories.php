<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 *
 * @property Categories $parent
 * @property Categories[] $categories
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName ()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return [
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels ()
    {
        return [
            'id'        => 'ID',
            'title'     => 'Title',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent ()
    {
        return $this->hasOne(Categories::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories ()
    {
        return $this->hasMany(Categories::className(), ['parent_id' => 'id']);
    }
}
