<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

/**
 * This is the model class for table "plot".
 *
 * @property int $id
 * @property string $cadastraNumber
 * @property string $address
 * @property float $price
 * @property float $area
 * @property int $created_at
 * @property int $updated_at
 */
class Plot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%plot}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cadastraNumber', 'address', 'price', 'area'], 'required'],
            [['price', 'area'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
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
            'updated_at' => Yii::t('app', 'Updatet At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getByCadastra(string $inputCadastr)
    {
        $inputArray = explode(',', trim($inputCadastr, ","));

        $query = self::find()->where(['cadastraNumber' => $inputArray]);

        $plots = $query->all();

        $updatePrepare = [];
        $newPlotArray = [];

        if (count($plots) < count($inputArray)) {
            $updatePrepare = $newPlotArray = array_diff($inputArray, ArrayHelper::getColumn($plots, 'cadastraNumber'));
        }

        if (($query->andWhere(['<', 'updated_at', strtotime('-1 second')])->count()) > 0) {
            $oldesPlots = $query->andWhere(['<', 'updated_at', strtotime('-1 second')])->all();
            $updatePrepare = array_merge($updatePrepare, ArrayHelper::getColumn($oldesPlots, 'cadastraNumber'));
        }

        if (!empty($updatePrepare)) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl('https://api.pkk.bigland.ru/test/plots')
                ->setData(['collection' => ['plots' => $updatePrepare]])
                ->send();
            if ($response->isOk) {
                $newParcerData = ArrayHelper::map($response->getData(), 'number', 'attrs');
                if (!empty($newPlotArray)) {
                    foreach ($newPlotArray as $item) {
                        $newPlot = new self();
                        $newPlot->cadastraNumber = $item;
                        $newPlot->address = $newParcerData[$item]['plot_address'];
                        $newPlot->price = $newParcerData[$item]['plot_price'];
                        $newPlot->area = $newParcerData[$item]['plot_area'];
                        $newPlot->save();
                    }
                }

                if (!empty($oldesPlots)) {
                    foreach ($oldesPlots as $item) {
                        $item->address = $newParcerData[$item->cadastraNumber]['plot_address'];
                        $item->price = $newParcerData[$item->cadastraNumber]['plot_price'];
                        $item->area = $newParcerData[$item->cadastraNumber]['plot_area'];
                        $item->update();
                    }
                }
            }
        }

        return self::find()->where(['cadastraNumber' => $inputArray])->all();
    }
}
