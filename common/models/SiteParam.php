<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "site_param".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int $sort_order
 */
class SiteParam extends \common\db\MyActiveRecord
{
    const COMPANY_NAME = 'company_name';
    const LOGO_IMAGE_SRC = 'logo_image_src';
    const ADDRESS = 'address';
    const PHONE_NUMBER = 'phone_number';
    const HOTLINE = 'hotline';
    const EMAIL = 'email';
    const FACEBOOK_PAGE_URL = 'facebook_page_url';
    const FOOTER_INFO_HTML = 'footer_info_html';
    const TRACKING_CODE = 'tracking_code';

    /**
     * @return string[]
     */
    public function getParamLabels()
    {
        return [
            self::COMPANY_NAME => 'Company Name',
            self::LOGO_IMAGE_SRC => 'Logo Image Src',
            self::ADDRESS => 'Address',
            self::PHONE_NUMBER => 'Phone Number',
            self::HOTLINE => 'Hotline',
            self::EMAIL => 'Email',
            self::FACEBOOK_PAGE_URL => 'Facebook page URL',
            self::FOOTER_INFO_HTML => 'Footer Info HTML',
            self::TRACKING_CODE => 'Tracking Code',
        ];
    }

    /**
     * @return string
     */
    public function paramLabel()
    {
        $paramLabels = $this->getParamLabels();
        if (isset($paramLabels[$this->name])) {
            return $paramLabels[$this->name];
        } else {
            return $this->name;
        }
    }

    private static $_indexData;

    /**
     * @return self[]
     */
    public static function indexData()
    {
        if (self::$_indexData == null) {
            self::$_indexData = self::find()->orderBy('sort_order asc')->indexBy('id')->all();
        }

        return self::$_indexData;
    }

    /**
     * @param $name
     * @return self|null
     */
    public static function findOneByName($name)
    {
        $data = self::indexData();
        foreach ($data as $item) {
            if ($item->name == $name) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @param $names
     * @param $limit
     * @return self[]
     */
    public static function findAllByNames($names, $limit = INF)
    {
        $result = [];
        $data = self::indexData();
        $i = 0;
        foreach ($data as $item) {
            if (in_array($item->name, $names)) {
                $result[] = $item;
                $i++;
            }
            if ($i >= $limit) {
                break;
            }
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'sort_order'], 'required'],
            [['sort_order'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['value'], 'string', 'max' => 2047],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'sort_order' => 'Sort Order',
        ];
    }
}
