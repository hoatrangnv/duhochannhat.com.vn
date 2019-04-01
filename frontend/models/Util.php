<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/10/2018
 * Time: 10:07 PM
 */

namespace frontend\models;


use common\models\Article;
use yii\web\View;

class Util
{
    public static function embedAdvisoryFormToContent(View $view, $content, Article $article = null) {

        $preg_open = "[[";
        $preg_close = "]]";
        $preg_pattern_template = "/open([\\s\\S]*?)close/";
        $preg_pattern = str_replace(
            ['open', 'close'],
            [preg_quote($preg_open), preg_quote($preg_close)],
            $preg_pattern_template
        );

        $preg_callback = function ($matches) use ($view, $article) {
            switch (trim($matches[1])) {
                case 'ADVISORY_FORM_ALL':
                    return $view->render('//contact/_form');
                case 'ADVISORY_FORM_JAPAN':
                    return $view->render('//contact/_form', ['country' => 'Nhật Bản']);
                case 'ADVISORY_FORM_KOREA':
                    return $view->render('//contact/_form', ['country' => 'Hàn Quốc']);
                case 'ARTICLE_RELATED':
                    if ($article !== null) {
                        return $view->render('//article/_related', ['article' => $article]);
                    }
            }

            return $matches[0];
        };

        return preg_replace_callback($preg_pattern, $preg_callback, $content);
    }
}