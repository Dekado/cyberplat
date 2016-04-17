<?php
/**
 * Created by PhpStorm.
 * User: Dekado
 * Date: 17.04.2016
 * Time: 10:27
 */
namespace app\components;
use yii;

class Helper {


    public static function addToBreadcrumbs($ancor, $url){
        if(property_exists(get_class(Yii::$app->controller), 'breadCrumbs')){
            Yii::$app->controller->breadCrumbs[] = [$ancor => $url];
        }
    }
    public static function removeLastBreadCrumb(){
        unset(Yii::$app->controller->breadCrumbs[ count(Yii::$app->controller->breadCrumbs)-1 ]);
    }

    public static function resetBreadcrumbs()
    {
        Yii::$app->controller->breadCrumbs = ['0' => ['Главная' => '/']];
    }


    public static function translite($string, $lowerCase = false)
    {
        $table = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TC', 'Ч' => 'CH',
            'Ш' => 'SH', 'Щ' => 'SCH', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',

            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
            'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'tc', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        );

        $output = str_replace(
            array_keys($table),
            array_values($table), $string
        );


        $output = preg_replace('/[\s+]/u', '-', $output);

        $output = preg_replace('/[^a-z0-9-\s]/i', '', $output);

        $output = preg_replace('/-+/', '-', $output);

        if($lowerCase) {
            return strtolower($output);
        } else {
            return $output;
        }
    }

    public static function buildTree($cats, $parentId, $onlyParent = false)
    {
        if (is_array($cats) and isset($cats[$parentId])) {
            $tree = '<ul>';
            if ($onlyParent == false) {
                foreach ($cats[$parentId] as $cat) {
                    $tree .= '<li><a href="/category/'.$cat['alias'].'">' . $cat['name'].'</a>';// . ' #' . $cat['id'];
                    $tree .= self::buildTree($cats, $cat['id']);
                    $tree .= '</li>';
                }
            } elseif (is_numeric($onlyParent)) {
                $cat = $cats[$parentId][$onlyParent];
                $tree .= '<li><a href="/category/'.$cat['alias'].'">' . $cat['name'].'</a>';// . ' #' . $cat['id'];
                $tree .= self::buildTree($cats, $cat['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        } else {
            return null;
        }
        return $tree;
    }

}