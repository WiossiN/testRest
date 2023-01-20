<?php

/** @var yii\web\View $this */

use yii\bootstrap4\Html;
use yii\grid\GridView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Поиск</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <?= Html::beginForm(['/'], 'GET', ['id' => 'search-form']); ?>

                <?= Html::textInput('textInput', Yii::$app->request->get('textInput'), ['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']); ?>
                </div>

                <?= Html::endForm(); ?>
            </div>
            <?php if ($dataProvider) { ?>
                <div class="col-lg-12">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'cadastraNumber',
                            'address',
                            'price',
                            'area',
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
    #search-form {
        text-align: center;
    }
    input {
        margin-bottom: 10px;
    }
</style>