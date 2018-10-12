<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/10/2018
 * Time: 10:07 PM
 */

namespace frontend\models;


use yii\web\View;

class Util
{
    public static function embedAdvisoryFromToContent(View $view, $content) {

        $preg_open = "[[";
        $preg_close = "]]";
        $preg_pattern_template = "/open((?:(?!open)(?!close)[\\s\\S])*)close/";
        $preg_pattern = str_replace(
            ['open', 'close'],
            [preg_quote($preg_open), preg_quote($preg_close)],
            $preg_pattern_template
        );

        $preg_callback = function ($matches) use ($view) {
            switch (trim($matches[1])) {
                case 'ADVISORY_FORM_ALL':
                    return $view->render('//contact/_form');
                case 'ADVISORY_FORM_JAPAN':
                    return $view->render('//contact/_form', ['country' => 'Nhật Bản']);
                case 'ADVISORY_FORM_KOREA':
                    return $view->render('//contact/_form', ['country' => 'Hàn Quốc']);
            }

            return $matches[0];
        };

        return preg_replace_callback($preg_pattern, $preg_callback, $content);
    }
}