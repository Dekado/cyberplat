<?php

namespace app\models;

use Yii;
use app\components\Helper;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $status
 * @property string $name
 * @property string $alias
 * @property integer $category
 * @property integer $created
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'category', 'created'], 'integer'],
            [['name', 'category', 'created'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['alias'], 'string', 'max' => 300],
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
            'name' => 'Name',
            'alias' => 'Alias',
            'category' => 'Category',
            'created' => 'Created',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($insert) { //если создается новая запись
                $this->alias = Helper::translite($this->name, true);
                $flag = true;
                while($flag) {
                    $checkAlias = Product::find()->where(['alias' => $this->alias])->count();
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
                    $checkAlias = Product::find()->where(['alias' => $this->alias])->andWhere(['!=', 'id', $this->id])->count();

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
