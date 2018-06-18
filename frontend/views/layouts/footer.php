<?php
/**
 * Created by PhpStorm.
 * User: Quyet
 * Date: 1/8/2018
 * Time: 9:20 AM
 */
use common\models\SiteParam;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<footer>
    <div class="container">
        <ul>
            <?php
            foreach (SiteParam::findAllByNames([
                SiteParam::COMPANY_NAME,
                SiteParam::ADDRESS,
                SiteParam::PHONE_NUMBER,
                SiteParam::HOTLINE,
                SiteParam::EMAIL,
            ]) as $item) {
                $value = Html::encode($item->value);
                switch ($item->name) {
                    case SiteParam::COMPANY_NAME:
                        ?>
                        <li class="com-name">
                            <span><?= $value ?></span>
                        </li>
                        <?php
                        break;
                    case SiteParam::ADDRESS:
                        ?>
                        <li class="address">
                            <span>Địa chỉ:</span>
                            <span><?= $value ?></span>
                        </li>
                        <?php
                        break;
                    case SiteParam::PHONE_NUMBER:
                        ?>
                        <li class="phone-number">
                            <span>Điện thoại:</span>
                            <a href="tel:<?= $value ?>" title="Bấm để gọi"><?= $value ?></a>
                        </li>
                        <?php
                        break;
                    case SiteParam::HOTLINE:
                        ?>
                        <li class="hotline">
                            <span>Hotline:</span>
                            <a href="tel:<?= $value ?>" title="Bấm để gọi"><?= $value ?></a>
                        </li>
                        <?php
                        break;
                    case SiteParam::EMAIL:
                        ?>
                        <li class="email">
                            <span>Email:</span>
                            <a href="mailto:<?= $value ?>" title="Gửi email"><?= $value ?></a>
                        </li>
                        <?php
                        break;

                }
            }
            ?>
        </ul>
    </div>
</footer>
