<?php

use yii\helpers\Html;

//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\bootstrap4\Carousel;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model backend\modules\sarabun\models\sarabun */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sarabuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?=  DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'responsive' => true,

        'mode' => DetailView::MODE_VIEW,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'panel' => [
            'heading' => 'ข้อมูลเอกสาร # ',
            'type' => DetailView::TYPE_INFO,
        ],

                        'attributes' => [
                            [
                                'group' => true,
                                'label' => 'ส่วนที่ 1 : ข้อมูลทั่วไป',
                                'rowOptions' => ['class' => 'table-info']
                            ],

                            'id',
                            'years',
                            'books',
                            'detills',
                            ['attribute'=>'bookdate','value'=>Yii::$app->thaiFormatter->asDate($model->bookdate, 'long')],
                            ['attribute'=>'docurl','value'=>$model->listDownloadFiles('docurl'),'format'=>'html'],
                            'kinds',
                            'kinds2',
                            [
                                'attribute'=>'created_at',
                                'label'=>'บันทึกเมื่อ #',
                                'value'=> Yii::$app->thaiFormatter->asDate($model->created_at, 'long').'    ผู้บันทึก:: '.$model->created_by,
                                'displayOnly'=>true,
                               // 'valueColOptions'=>['style'=>'width:30%']
                            ],
                            [
                                'attribute'=>'updated_at',
                                'label'=>'แก้ใขล่าสุดเมื่อ #',
                                'value'=>Yii::$app->thaiFormatter->asDate($model->updated_at, 'long').'    ผู้แก้ใข:: '.$model->updated_by,
                                //'valueColOptions'=>['style'=>'width:30%'],
                                'displayOnly'=>true
                            ],
                /*            'created_at',
                            'updated_at',
                            'created_by',
                            'updated_by',*/

                           // 'unit.name',
                           // 'collection.name',
                            [
                                'attribute'=>'unit',
                                'value'=>$model->unit->name,

                            ],
                                                        [
                                'attribute'=>'collection',
                                                            'label'=>'แฟ้ม #',
                                'value'=>$model->collection->name,

                            ]

                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>