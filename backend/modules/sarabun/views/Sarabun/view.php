<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sarabun\models\sarabun */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sarabuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'Idyear',
                            'years',
                            'books',
                            'detills',
                            ['attribute'=>'bookdate','value'=>Yii::$app->thaiFormatter->asDate($model->bookdate, 'long')],
                            ['attribute'=>'docurl','value'=>$model->listDownloadFiles('docurl'),'format'=>'html'],
                            'kinds',
                            'kinds2',
                            'created_at',
                            'updated_at',
                            'created_by',
                            'updated_by',
                            'unit.name',
                            'collection.name',
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