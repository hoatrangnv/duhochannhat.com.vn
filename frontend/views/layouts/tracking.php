<?php
use common\models\SiteParam;

foreach (SiteParam::findAllByNames([SiteParam::TRACKING_CODE]) as $trackingCode) {
    echo $trackingCode->value;
}