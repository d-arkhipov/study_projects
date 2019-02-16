<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $responsible */
/* @var $status */
/* @var $userId */
/* @var $projectId */

$this->title = 'Create task';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['project/']];
$this->params['breadcrumbs'][] = ['label' => $projectId, 'url' => Url::to(['project/project', 'id' => $projectId])];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner_id')->hiddenInput(['value' => $userId])->label(false); ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($responsible, ['prompt' => 'Set responsible']) ?>

    <?= $form->field($model, 'status_id')->dropDownList($status, [
        'value' => '1'
    ]) ?>

    <?= $form->field($model, 'date_start')->widget('kartik\date\DatePicker', [
        'name' => 'date_start',
        'options' => ['placeholder' => 'Select start date'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'date_end')->widget('kartik\date\DatePicker', [
        'name' => 'date_end',
        'options' => ['placeholder' => 'Select finish date'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $projectId])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>