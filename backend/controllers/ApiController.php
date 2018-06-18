<?php
/**
 * Created by PhpStorm.
 * User: Quyet
 * Date: 1/4/2018
 * Time: 4:10 PM
 */

namespace backend\controllers;

use backend\models\Article;
use backend\models\Tag;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;
use common\models\Image;
use yii\rest\Controller;

class ApiController extends Controller
{
    const DEFAULT_IMAGE_QUALITY = 80;


    public function actionFindArticles($q = '', $page = 1)
    {
        /**
         * @var Article[] $articles
         */

        $articles = Article::find()
            ->where(['like', 'name', $q])
            ->offset($page - 1)
            ->limit(30)
            ->orderBy('published_time desc')
            ->all();

        $result = [
            'items' => [],
            'total_count' => Article::find()
                ->where(['like', 'name', $q])
                ->count()
        ];

        foreach ($articles as $article) {
            $result['items'][] = [
                'id' => $article->id,
                'name' => $article->name,
                'avatar' => $article->avatarImage ? $article->avatarImage->getSource() : '',
            ];
        }

        return $result;
    }
    
    public function actionFindTags($q = '', $page = 1)
    {
        /**
         * @var Tag[] $tags
         */

        $tags = Tag::find()
            ->where(['like', 'name', $q])
            ->offset($page - 1)
            ->limit(30)
            ->orderBy('sort_order desc')
            ->all();

        $result = [
            'items' => [],
            'total_count' => Tag::find()
                ->where(['like', 'name', $q])
                ->count()
        ];

        foreach ($tags as $tag) {
            $result['items'][] = [
                'id' => $tag->id,
                'name' => $tag->name,
                'avatar' => $tag->avatarImage ? $tag->avatarImage->getSource() : '',
            ];
        }

        return $result;
    }
    
    public function actionFindImages($q = '', $page = 1)
    {
        /**
         * @var Image[] $images
         */

        $images = Image::find()
            ->where(['like', 'name', $q])
            ->offset($page - 1)
            ->limit(30)
            ->orderBy('created_time desc')
            ->all();

        $result = [
            'items' => [],
            'total_count' => Image::find()
                ->where(['like', 'name', $q])
                ->count()
        ];

        foreach ($images as $image) {
            $result['items'][] = [
                'id' => $image->id,
                'name' => $image->name,
                'width' => $image->width,
                'height' => $image->height,
                'aspect_ratio' => $image->aspect_ratio,
                'source' => $image->getSource(),
            ];
        }

        return $result;
    }

    public function actionFindImage()
    {
        $id = Yii::$app->request->getBodyParam('id');
        $image = Image::findOne($id);
        if ($image) {
            return [
                'id' => $image->id,
                'name' => $image->name,
                'width' => $image->width,
                'height' => $image->height,
                'aspect_ratio' => $image->aspect_ratio,
                'source' => $image->getSource(),
            ];
        }
        return null;
    }

    public function actionUploadImage()
    {
        $module = Yii::$app->getModule('image');
        $file = UploadedFile::getInstanceByName('image_file');
        $image = new Image();
        $image->quality = self::DEFAULT_IMAGE_QUALITY;
        $image->image_name_to_basename = true;
        $image->input_resize_keys = $module->params['input_resize_keys'];
        if ($image->saveFileAndModel($file)) {
            return [
                'success' => true,
                'image' => [
                    'id' => $image->id,
                    'name' => $image->name,
                    'width' => $image->width,
                    'height' => $image->height,
                    'aspect_ratio' => $image->aspect_ratio,
                    'source' => $image->getSource()
                ]
            ];
        } else {
            return [
                'success' => false,
                'errors' => $image->getErrors()
            ];
        }
    }

    public function actionCkeditorUploadImage()
    {
        Yii::$app->response->format = Response::FORMAT_RAW;

        $module = Yii::$app->getModule('image');

        $funcNum = (string) Yii::$app->request->get('CKEditorFuncNum');
        $funcNum = preg_replace('/[^0-9]/', '', $funcNum);
        //$editor = Yii::$app->request->get('CKEditor');

        $file = UploadedFile::getInstanceByName('upload');
        $image = new Image();
        $image->quality = self::DEFAULT_IMAGE_QUALITY;
        $image->image_name_to_basename = true;
        $image->input_resize_keys = $module->params['input_resize_keys'];
        if ($image->saveFileAndModel($file)) {
            $errorMessage = '';
            $fileUrl = $image->getSource() . '?image_id=' . $image->id;
        } else {
            $errorMessage = Yii::t('app', 'Image was not uploaded') . ': ';
            foreach ($image->getErrors() as $attr => $errors) {
                $errorMessage .=
                    "\n    $attr:\n        " .
                    implode("\n        ",
                        array_map(function ($error) {
                            return str_replace('"', "'", $error);
                        }, $errors)
                    );
            }
            $fileUrl = '';
        }
        ob_start();
        ?>
        <script type="text/javascript">
            /**
             * http://docs.cksource.com/CKEditor_3.x/Developers_Guide/File_Browser_(Uploader)/Custom_File_Browser
             */
            window.parent.CKEDITOR.tools.callFunction(<?php echo json_encode($funcNum); ?>, <?php echo json_encode($fileUrl); ?>, <?php echo json_encode($errorMessage); ?>);
        </script>
        <?php
    }
}