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
        <div class="clr">
            <ul class="info-block">
                <?php
                if ($company = SiteParam::findOneByName(SiteParam::COMPANY)) {
                    ?>
                    <li class="company">
                        <span><?= $company->value ?></span>
                    </li>
                    <?php
                }

                if ($address = SiteParam::findOneByName(SiteParam::ADDRESS)) {
                    ?>
                    <li class="address">
                        <?= $address->value ?>
                    </li>
                    <?php
                }

                $phone_values = array_map(function (SiteParam $param) {
                    return \yii\helpers\Html::a($param->value, "tel:$param->value");
                }, SiteParam::findAllByNames([SiteParam::PHONE]));

                $email_values = array_map(function (SiteParam $param) {
                    return \yii\helpers\Html::a($param->value, "mailto:$param->value");
                }, SiteParam::findAllByNames([SiteParam::EMAIL]));

                if (count($phone_values) > 0) {
                    ?>
                    <li class="hotlines">Hotline: <?= implode(', ', $phone_values) ?></li>
                    <?php
                }

                if (count($email_values) > 0) {
                    ?>
                    <li class="emails">Email: <?= implode(', ', $email_values) ?></li>
                    <?php
                }

                ?>
            </ul>

            <div class="social-block">
                <?php
                if ($fb = SiteParam::findOneByName(SiteParam::FACEBOOK_PAGE)) {
                    ?>
                    <a href="<?= $fb->value ?>" title="Facebook" target="_blank" rel="nofollow">
                        <i class="icon facebook-icon"></i>
                    </a>
                    <?php
                }
                if ($ins = SiteParam::findOneByName(SiteParam::INSTAGRAM_PAGE)) {
                    ?>
                    <a href="<?= $ins->value ?>" title="Instagram" target="_blank" rel="nofollow">
                        <i class="icon instagram-icon"></i>
                    </a>
                    <?php
                }
                if ($yt = SiteParam::findOneByName(SiteParam::YOUTUBE_CHANNEL)) {
                    ?>
                    <a href="<?= $yt->value ?>" title="Youtube" target="_blank" rel="nofollow">
                        <i class="icon youtube-icon"></i>
                    </a>
                    <?php
                }
                if ($twt = SiteParam::findOneByName(SiteParam::TWITTER_PAGE)) {
                    ?>
                    <a href="<?= $twt->value ?>" title="Pinterest" target="_blank" rel="nofollow">
                        <i class="icon twitter-icon"></i>
                    </a>
                    <?php
                }
                if ($tumblr = SiteParam::findOneByName(SiteParam::TUMBLR_PAGE)) {
                    ?>
                    <a href="<?= $tumblr->value ?>" title="Tumblr" target="_blank" rel="nofollow">
                        <i class="icon tumblr-icon"></i>
                    </a>
                    <?php
                }
                if ($pin = SiteParam::findOneByName(SiteParam::PINTEREST_PAGE)) {
                    ?>
                    <a href="<?= $pin->value ?>" title="Pinterest" target="_blank" rel="nofollow">
                        <i class="icon pinterest-icon"></i>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="dmca">
            <a href="//www.dmca.com/Protection/Status.aspx?id=0dec6bd0-01fa-4e56-a3e0-bda48ce6588a" title="DMCA.com Protection Status" class="dmca-badge">
                <img src="//images.dmca.com/Badges/dmca-badge-w150-5x1-01.png?ID=0dec6bd0-01fa-4e56-a3e0-bda48ce6588a" alt="DMCA.com Protection Status">
            </a>
            <script src="//images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
        </div>
    </div>
</footer>
