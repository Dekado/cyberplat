<?php
use app\components\Helper;
/* @var $this yii\web\View */

$this->title = 'Catalogue';

?>
<div class="col-xs-12">

<?php
//Ссылка на родительскую категорию
if(isset($parentCategory)) {
    echo '<a href="/category/'.$parentCategory->alias.'">Родительская категория</a><br>';
}

//Ссылка на первый уровень view
if(isset($currentCategory) && $currentCategory->parent_id == 0) {
    echo '<a href="/">Родительская категория</a><br>';
    echo $currentCategory->name;
} elseif(isset($currentCategory)) {
    echo $currentCategory->name;
}

//Вывод списка категорий, используется класс помощник app\components\Helper.
echo Helper::buildTree($cats, key($cats));

//Вывод товаров, если надо
if(isset($products) && count($products) > 0) {
    echo '<ul>';
    foreach($products as $product) {
        echo '<li>'.$product->name.'</li>';
    }
    echo '</ul>';
}
?>

</div>

