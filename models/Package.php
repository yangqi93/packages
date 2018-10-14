<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property int $company 快递公司
 * @property string $sn 快递单号
 * @property int $phone 收件人手机号
 * @property int $status 状态
 * @property string $address 库位
 * @property int $received_at 入库时间
 * @property int $signing_at 出库时间
 * @property int $created_at
 * @property int $updated_at
 */
class Package extends \yii\db\ActiveRecord
{
    const COMPANY_YUANTONG = 001;
    const COMPANY_ZHONGTONG = 002;
    const COMPANY_BAISHI = 003;
    const COMPANY_TIANTIAN = 004;
    const COMPANY_YUNDA = 005;
    const COMPANY_SHENTONG = 006;
    const COMPANY_YOUZHENG = 007;
    const COMPANY_WANXIANG = 010;
    const COMPANY_CAINIAO = 011;
    const COMPANY_JINGDONG = 012;
    const COMPANY_OTHER = 055;

    const STATUS_RECEIVE = 0; //入库
    const STATUS_SIGN = 1; //签收
    const STATUS_DO_NOT_SIGN = 2; //拒收
    const STATUS_REFUND = 3; //退回
    const STATUS_LOST = 9; //丢件

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = TimestampBehavior::class;
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company', 'phone', 'status', 'received_at', 'signing_at', 'created_at', 'updated_at'], 'integer'],
            [['company', 'sn'], 'required'],
            ['status', 'default', 'value' => 0],
            ['received_at', 'default', 'value' => time()],
            ['phone', 'default', 'value' => 0],
            ['signing_at', 'default', 'value' => 0],
            [['sn'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company' => Yii::t('app', 'Company'),
            'sn' => Yii::t('app', 'Sn'),
            'phone' => Yii::t('app', 'Phone'),
            'status' => Yii::t('app', 'Status'),
            'address' => Yii::t('app', 'Address'),
            'received_at' => Yii::t('app', 'Received At'),
            'signing_at' => Yii::t('app', 'Signing At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * 快递公司
     * @return array
     */
    public static function getCompanies()
    {
        return [
            self::COMPANY_YUANTONG => '圆通',
            self::COMPANY_ZHONGTONG => '中通',
            self::COMPANY_BAISHI => '百世汇通/中通',
            self::COMPANY_TIANTIAN => '天天',
            self::COMPANY_YUNDA => '韵达',
            self::COMPANY_SHENTONG => '申通',
            self::COMPANY_YOUZHENG => '邮政',
            self::COMPANY_WANXIANG => '万象物流',
            self::COMPANY_CAINIAO => '菜鸟',
            self::COMPANY_JINGDONG => '京东',
            self::COMPANY_OTHER => '未知'
        ];
    }

    public function checkCompany($sn)
    {
        //圆通
        if (preg_match("/^8[0-9]{11,17}$/", $sn)) {
            return self::COMPANY_YUANTONG;
        }
        //中通
        if (preg_match('/^2[0-9]{11}$/', $sn)) {
            return self::COMPANY_ZHONGTONG;
        }
        //百世
        if (preg_match('/^7[0-9]{13}$/', $sn)) {
            return self::COMPANY_BAISHI;
        }
        //天天
        if (preg_match('/^66[0-9]{10}$/', $sn)) {
            return self::COMPANY_TIANTIAN;
        }

        //其它
        return self::COMPANY_OTHER;
    }

    /**
     * 快递状态
     * @return array
     */
    public static function getStatus()
    {
        return [
            self::STATUS_RECEIVE => '入库',
            self::STATUS_SIGN => '签收',
            self::STATUS_DO_NOT_SIGN => '拒收',
            self::STATUS_REFUND => '退回',
            self::STATUS_LOST => '丢件'
        ];
    }
}
