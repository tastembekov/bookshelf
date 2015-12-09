<?php

use app\models\Author;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?php echo Html::img($model->image->real_path, ['width' => '100%', 'height' => 'auto', 'class' => 'form-group'])?>
        </div>
        <div class="col-md-9">
            <?= $form->field($model, 'author_id')->dropDownList(
                    ArrayHelper::map(Author::find()->all(), 'id', 'fullname'),
                    ['prompt' => Yii::t('app', 'Choose author')]
                ); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'date')
                ->widget(\yii\jui\DatePicker::classname(),[
                    'language' => Yii::$app->language,
                    'dateFormat' => 'php:Y-m-d',
                    'options' => ['class' => 'form-control']
                ]);?>
            <?= $form->field($model, 'date_create')
                ->widget(\yii\jui\DatePicker::classname(),[
                    'language' => Yii::$app->language,
                    'dateFormat' => 'php:Y-m-d',
                    'options' => ['class' => 'form-control']
                ]);?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= Html::submitButton(Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
