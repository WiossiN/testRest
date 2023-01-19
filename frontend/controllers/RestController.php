<?php

namespace frontend\controllers;

use common\models\Plot;
use yii\rest\ActiveController;

class RestController extends ActiveController
{
    public $modelClass = Plot::class;
}
