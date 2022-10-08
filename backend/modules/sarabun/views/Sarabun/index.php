<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\sarabun\models\Sarabun;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sarabun\models\SarabunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ระบบงานสารบรรณ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('บันทึกทะเบียนรับ/ส่ง', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            // ['class' => 'yii\grid\SerialColumn'],
                            // 'id',
                            // 'years',
                            'Idyear',
                            [
                                'attribute'=>'kinds',
                                'filter'=>Sarabun::itemsAlias('book'),

                            ],
                            [
                                'attribute'=> 'kinds2',
                                'filter'=>Sarabun::itemsAlias('bookkind'),

                            ],
                             // 'unit_id',
                            [
                                'attribute' => 'unit',
                                'value' => 'unit.name', //relation name with their attribute
                            ],
                            'books',
                            [
                                'attribute' => 'bookdate',
                                'value' => function ($model) {
                                    return Yii::$app->thaiFormatter->asDate($model->bookdate, 'long');
                                }
                            ],

                            'detills',
                            //'bookdate',
                            //'docurl',

                          //'created_at',
                            //'updated_at',
                            //'created_by',
                            //'updated_by',
                            //'unit_id',
                            //'collection_id',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
