<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\sarabun\models\Collection */
/* @var $form yii\bootstrap4\ActiveForm */
?>


<div class="collection-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <?= \hail812\adminlte\widgets\Alert::widget([
            'type' => 'success',
            'body' => '<h3>หลักการตั้งรหัสแฟ้ม!</h3><p>การตั้งรหัสเป็นเลขชุด 4 ตัวตังนี้ <br>เลขหลักที่ 1 หมายถึง ประเภทแฟ้ม 1 หมายถึงรับ 2 หมายถึงส่ง <br>เลขหลักที่ 2 ประเภทของแฟ้ม 1 หมายถึงทั่วไป 2 หมายถึง สาธาณูปโภค 3 หมายถึงอาวุธ 4 หมายถึงสถานภาพ สป.ต่างๆ 5 หมายถึง อาคารและที่ดิน <br>หลักที่สามและที่คือหมายเลขแฟ้มของแต่ละเรื่อง<br>ตัวอย่าง : หากต้องการตั้งแฟ้มรับ ชนิด รับ ประเภทอาวุธ และหมายเลขแฟ้ม 25 ตั้งดังนี้ 1325 หมายเลขแฟ้มต้องไม่ซ้ำกับของเดิมที่มีอยู่แล้ว </p>',
        ]) ?>
    </div>

    <?= $form->field($model, 'id')->textInput()->hint('ใส่รหัสประจำแฟ้ม 4 หลัก')/*->label('รหัสประจำแฟ้ม4หลัก')*/  ?>

    <?= $form->field($model, 'mastername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detills')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
