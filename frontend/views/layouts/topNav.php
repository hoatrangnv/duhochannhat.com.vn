<?php
/**
 * Created by PhpStorm.
 * User: Quyet
 * Date: 4/24/2018
 * Time: 2:21 PM
 *
 * @var $menu vanquyet\menu\Menu
 */
use yii\helpers\Url;

?>
<div id="top-nav">
    <div class="container">
        <span class="menu-toggle sm-only"
              onclick="document.querySelector('html').classList.toggle('menu-active')"
        >
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 53 53" xml:space="preserve">
                <path d="M2,13.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,13.5,2,13.5z"></path>
                <path d="M2,28.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,28.5,2,28.5z"></path>
                <path d="M2,43.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,43.5,2,43.5z"></path>
            </svg>
        </span>
        <ul class="menu clr">
            <li class="menu-header sm-only">
                <span class="close-button" onclick="document.querySelector('html').classList.remove('menu-active')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408 408" width="1.2em" height="1.2em">
                        <path fill="#fff" d="M408 178.5H96.9L239.7 35.7 204 0 0 204l204 204 35.7-35.7L96.9 229.5H408v-51z"></path>
                    </svg>
                </span>
            </li>
            <?php
            foreach ($menu->getRootItems() as $item) {
                /**
                 * @var $item \vanquyet\menu\MenuItem
                 * @var $children \vanquyet\menu\MenuItem[]
                 * @var $grandchildren \vanquyet\menu\MenuItem[]
                 */
                $children = $item->getChildren();
                ?>
                <li<?= $item->isActive() ? ' class="active"' : '' ?>>
                    <?php
                    if (empty($children)) {
                        echo $item->a();
                    } else {
                        ?>
                        <span class="sub-menu-toggle<?= $item->isActive() ? ' active' : '' ?>"
                              onclick="this.classList.toggle('active')"></span>
                        <?= $item->a() ?>
                        <ul class="sub-menu">
                            <?php
                            foreach ($children as $child) {
                                ?>
                                <li<?= $child->isActive() ? ' class="active"' : '' ?>>
                                    <?php
                                    $grandchildren = $child->getChildren();
                                    if (empty($grandchildren)) {
                                        echo $child->a();
                                    } else {
                                        ?>
                                        <span class="sub-menu-toggle<?= $child->isActive() ? ' active' : '' ?>"
                                              onclick="this.classList.toggle('active')"></span>
                                        <?= $child->a() ?>
                                        <ul class="sub-menu">
                                            <?php
                                            foreach ($grandchildren as $grandchild) {
                                                echo ($grandchild->isActive() ? '<li class="active">' : '<li>')
                                                    . $grandchild->a() . '</li>';
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
            <!--<li class="active">
                <a>Trang chủ</a>
            </li>
            <li>
                <span class="sub-menu-toggle" onclick="this.classList.toggle('active')"></span>
                <a>Nhà đất bán</a>
                <ul class="sub-menu">
                    <li>
                        <span class="sub-menu-toggle" onclick="this.classList.toggle('active')"></span>
                        <a>Demo Sub item 1</a>
                        <ul class="sub-menu">
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>Demo demo Sub item 1</a>
                    </li>
                    <li>
                        <a>Sub item 1</a>
                    </li>
                    <li>
                        <span class="sub-menu-toggle" onclick="this.classList.toggle('active')"></span>
                        <a>Demo Sub item 1</a>
                        <ul class="sub-menu">
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                            <li>
                                <a>Demo sub item 2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a>Nhà đất cho thuê</a>
            </li>
            <li>
                <a>Dự án</a>
            </li>
            <li>
                <span class="sub-menu-toggle" onclick="this.classList.toggle('active')"></span>
                <a>Cần mua - cần thuê</a>
                <ul class="sub-menu">
                    <li>
                        <a>Cần mua</a>
                    </li>
                    <li>
                        <a>Cần thuê</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?/*= Url::to(['article/index']) */?>">Tin tức</a>
            </li>-->
        </ul>
    </div>
</div>
