<?php

namespace console\controllers;

use common\models\Plot;
use yii\console\Controller;
use yii\console\ExitCode;

class ParcerController extends Controller
{
    /**
     * Register user from console.
     *
     * @return string
     */
    public function actionParce($inputCadastr)
    {
        $result = Plot::getByCadastra($inputCadastr);

        echo '---------------------------------------------------------------------------------------------------------------------------------------------------' . PHP_EOL;
        echo '|  CN                |  Addres                                                                                                     | Price | Area |' . PHP_EOL;

        foreach ($result as $item) {

            echo '---------------------------------------------------------------------------------------------------------------------------------------------------' . 
            PHP_EOL;
            echo '| ' . $item->cadastraNumber . ' | ' . $item->address . ' | ' . $item->price . ' | ' . $item->area . ' | ' . PHP_EOL;
        }

        echo '---------------------------------------------------------------------------------------------------------------------------------------------------' . PHP_EOL;

        return ExitCode::OK;
    }
}
