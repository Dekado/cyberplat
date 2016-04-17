<?php

namespace app\models;

use Yii;
use app\components\Helper;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $parent_id
 * @property string $name
 * @property string $alias
 * @property integer $created
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'parent_id', 'created'], 'integer'],
            [['name', 'created'], 'required'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'created' => 'Created',
        ];
    }

    //Проверка alias перед сохранением.
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($insert) { //если создается новая запись
                $this->alias = Helper::translite($this->name, true);
                $flag = true;
                while($flag) {
                    $checkAlias = Categories::find()->where(['alias' => $this->alias])->count();
                    if($checkAlias > 0) {
                        $this->alias = $this->alias.'-0';
                    } else {
                        $flag = false;
                    }
                }

                $this->created = time();

            } else {
                $this->alias = Helper::translite($this->name, true);

                $flag = true;
                while($flag) {
                    $checkAlias = Categories::find()->where(['alias' => $this->alias])->andWhere(['!=', 'id', $this->id])->count();

                    if($checkAlias > 0) {
                        $this->alias = $this->alias.'-0';
                    } else {
                        $flag = false;
                    }
                }
            }

            return true;

        } else {

            return false;

        }
    }
}
