<?php

namespace console\controllers;

use common\models\Plot;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\console\widgets\Table;

class ParcerController extends Controller
{
    /**
     * Register user from console.
     *
     * @return string
     */
    public function actionParce($inputCadastr)
    {
        $result = Plot::getByCadastra($inputCadastr)->asArray()->all();

        echo Table::widget([
            'headers' => ['ID', 'CN', 'Addres', 'Price', 'Area', 'Created', 'Updated'],
            'rows' => $result,
        ]);

        return ExitCode::OK;
    }
}
