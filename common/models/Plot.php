<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "plot".
 *
 * @property int $id
 * @property string $cadastraNumber
 * @property string $address
 * @property float $price
 * @property float $area
 * @property int $created_at
 * @property int $updatet_at
 */
class Plot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plot';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cadastraNumber', 'address', 'price', 'area', 'created_at', 'updatet_at'], 'required'],
            [['price', 'area'], 'number'],
            [['created_at', 'updatet_at'], 'integer'],
            [['cadastraNumber'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cadastraNumber' => Yii::t('app', 'Cadastra Number'),
            'address' => Yii::t('app', 'Address'),
            'price' => Yii::t('app', 'Price'),
            'area' => Yii::t('app', 'Area'),
            'created_at' => Yii::t('app', 'Created At'),
            'updatet_at' => Yii::t('app', 'Updatet At'),
        ];
    }
}
