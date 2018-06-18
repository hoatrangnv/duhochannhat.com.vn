<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/5/2017
 * Time: 12:38 AM
 */

namespace frontend\controllers;

use common\db\MyActiveQuery;
use common\models\MenuItem;
use common\models\StaticPageInfo;
use common\models\UrlParam;
use frontend\models\Article;
use frontend\models\ArticleCategory;
use frontend\models\Game;
use frontend\models\SeoInfo;
use Yii;
use yii\web\Controller;
use vanquyet\menu\Menu;
use yii\helpers\Url;
use Detection\MobileDetect;

class BaseController extends Controller
{
    /** @var Menu $menu */
    public $menu;
    /** @var Menu $bottomMenu */
    public $bottomMenu;
    /** @var string $screen */
    public $screenSize;
    /** @var SeoInfo $seoInfo */
    public $seoInfo;

    public function beforeAction($action)
    {
        Yii::$app->params['amp'] = ('amp' === Yii::$app->request->get(UrlParam::AMP));

        //TODO: Determines screen size
        $detect = new MobileDetect;
        switch (true) {
            case $detect->isTablet(): // tablet only
                $this->screenSize = 'medium';
                break;
            case $detect->isMobile(): // mobile or tablet
                $this->screenSize = 'small';
                break;
            default:
                $this->screenSize = 'large';
        }

        $this->menu = new Menu();
        $this->bottomMenu = new Menu();

        /**
         * @var $menuItems MenuItem[]
         * @var $bottomMenuItems MenuItem[]
         */
        $menuItems = MenuItem::indexData(MenuItem::MENU_ID_TOP);
        $bottomMenuItems = MenuItem::indexData(MenuItem::MENU_ID_BOTTOM);
        $menuData = [];
        foreach ($menuItems as $menuItem) {
            $menuData[$menuItem->getMenuKey()] = [
                'label' => $menuItem->label,
                'url' => $menuItem->getUrl(),
                'parentKey' => $menuItem->findParent() ? $menuItem->findParent()->getMenuKey() : null
            ];
        }
        $bottomMenuData = [];
        foreach ($bottomMenuItems as $bottomMenuItem) {
            $bottomMenuData[$bottomMenuItem->getMenuKey()] = [
                'label' => $bottomMenuItem->label,
                'url' => $bottomMenuItem->getUrl(),
                'parentKey' => $bottomMenuItem->findParent() ? $bottomMenuItem->findParent()->getMenuKey() : null
            ];
        }

        $this->menu->init(['data' => $menuData]);
        $this->bottomMenu->init(['data' => $bottomMenuData]);

        //TODO: Init Seo Info
        $this->seoInfo = new SeoInfo();

        // Load from Static Page Info
        if (in_array(Yii::$app->requestedRoute, array_keys((new StaticPageInfo())->getRouteLabels()))) {
            if ($model = StaticPageInfo::findOne(['active' => 1, 'route' => Yii::$app->requestedRoute])) {
                $this->seoInfo->loadAttrValues($model->attributes);
                $this->seoInfo->loadFromImageObject($model->avatarImage);
            }
        }

        return parent::beforeAction($action);
    }
}