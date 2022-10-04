<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use backend\modules\sarabun\models\Collection;
use backend\modules\sarabun\models\Unit;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\sarabun\models\sarabun */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="sarabun-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="row">
        <div class="col-3">

            <?= $form->field($model, 'kinds')->inline()->radioList($model->getItemBook()) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'kinds2')->inline()->radioList($model->getItemBookkind()) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'books')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'bookdate')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกวันที่เอกสาร ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <?= $form->field($model, 'detills')->textInput(['maxlength' => true]) ?>


        </div>
        <div class="col-6">
            <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
                'bsVersion' => '4.x',
                'data' => ArrayHelper::map(Unit::find()->all(), 'id', 'Fullname'),
                'options' => ['placeholder' => 'เลือกแฟ้ม ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

        </div>
        <div class="col-6">
            <?= $form->field($model, 'collection_id')->widget(Select2::classname(), [
                'bsVersion' => '4.x',
                'data' => ArrayHelper::map(Collection::find()->all(), 'id', 'Fullname'),
                'options' => ['placeholder' => 'เลือกแฟ้ม ...'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]); ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'docs')->widget(FileInput::classname(), [
                //'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreviewAsData' => true,
                    'initialPreviewFileType'=> 'pdf',
                    'initialPreview' => $model->initialPreview($model->docurl, 'docurl', 'file'), //<-----
                    'initialPreviewConfig' => $model->initialPreview($model->docurl, 'docurl', 'config'),//<-----
                    'allowedFileExtensions' => ['pdf'],
                    'showPreview' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                    'overwriteInitial' => true,
                ]
            ]); ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'ref')->hiddenInput()->label(false); ?>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <?= Html::submitButton('------ บันทึก ------', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
