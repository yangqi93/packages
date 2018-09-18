<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Package;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packages');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="package-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'company',
                'filter' => Package::getCompanies(),
                'value' => function ($model) {
                    return $model->getCompanies()[$model->company];
                }
            ],
            'sn',
            'phone',
            [
                'attribute' => 'status',
                'filter' => Package::getStatus(),
                'value' => function ($model) {
                    return $model->getStatus()[$model->status];
                }
            ],
            //'address',
            [
                'attribute' => 'received_at',
                'value' => function ($model) {
                    return date('Y-m-d H:i:s', $model->received_at);
                }
            ],
            [
                'attribute' => 'signing_at',
                'value' => function ($model) {
                    return $model->signing_at > 0 ? date('Y-m-d H:i:s', $model->signing_at) : null;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{sign} {update}',
                'header' => '操作',
                'buttons' => [
                    'sign' => function ($url, $model) {
                        if ($model->status == 0) {
                            return Html::a('<span class="btn btn-sm btn-info">签收</i></span>', $url);
                        }
                    },
                    'update' => function ($url) {
                        return Html::a('<span class="btn btn-sm btn-primary">修改</i></span>', $url);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
