<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Categories;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */

//Опции для новой записи
if($model->isNewRecord) {
    $model->status = 1;
    $model->created = time();
    $categories = Categories::find()->all(); //Для отображения select
} else {
    $categories = Categories::find()->where(['!=', 'parent_id', $model->parent_id])->all(); //Для отображения select, чтобы нельзя выбрать ту же самую категорию.
}

$categoryArrayForSelect = [0 => '--'];

foreach($categories as $category) {
    /* @var $category app\models\Categories */
    $categoryArrayForSelect[$category->id] = $category->name;
}
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->radioList([1 => 'Включено', 0 => 'Выключено']) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($categoryArrayForSelect) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
