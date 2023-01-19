<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Plot $model */

$this->title = Yii::t('app', 'Create Plot');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
