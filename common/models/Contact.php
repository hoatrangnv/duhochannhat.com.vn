<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_contact".
 *
 * @property int $id
 * @property string $title
 * @property string $message
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_email
 * @property int $status
 * @property int $type
 * @property int $updated_user_id
 * @property string $created_time
 * @property string $updated_time
 *
 * @property User $updatedUser
 */
class Contact extends \common\db\MyActiveRecord
{
    const TYPE__ADVISORY_REQUEST = 1;

    const STATUS__NEW = 1;
    const STATUS__SEEN = 2;
    const STATUS__REPLIED = 3;
    const STATUS__CLOSED = 4;

    public static $allTypeLabels = [
        self::TYPE__ADVISORY_REQUEST => 'Tư vấn',
    ];

    public static $allStatusLabels = [
        self::STATUS__NEW => 'Mới',
        self::STATUS__SEEN => 'Đã xem',
        self::STATUS__REPLIED => 'Đã trả lời',
        self::STATUS__CLOSED => 'Đã đóng',
    ];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',
                'updatedAtAttribute' => 'updated_time',
                'value' => (new \DateTime())->format('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_name', 'customer_phone', 'status', 'type'], 'required'],
            [['status', 'type', 'updated_user_id'], 'integer'],
            [['title', 'customer_name', 'customer_phone', 'customer_email'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 1023],
            ['type', 'in', 'range' => array_keys(self::$allTypeLabels)],
            ['status', 'in', 'range' => array_keys(self::$allStatusLabels)],
            [['updated_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'message' => 'Message',
            'customer_name' => 'Customer Name',
            'customer_phone' => 'Customer Phone',
            'customer_email' => 'Customer Email',
            'status' => 'Status',
            'type' => 'Type',
            'updated_user_id' => 'Updated User ID',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_user_id']);
    }
}
