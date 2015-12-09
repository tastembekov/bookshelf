<?php

use app\models\Author;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'author_id', ['template' => '{input}{error}'])
                ->dropDownList(
                    ArrayHelper::map(Author::find()->all(), 'id', 'fullname'),
                    ['prompt' => Yii::t('app', 'Choose author')]
                );
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'name', ['template' => '{input}{error}'])
                ->textInput(['placeholder' => Yii::t('app', 'Book name')]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <?php echo Yii::t('app', 'Published date')?>:
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'date_start', ['template' => '{input}{error}'])
                    ->widget(\yii\jui\DatePicker::classname(),[
                        'language' => Yii::$app->language,
                        'dateFormat' => 'php:Y-m-d',
                        'options' => ['class' => 'form-control']
                    ]);?>
                </div>
                <div class="col-md-1">
                    <?php echo Yii::t('app', 'until')?>:
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'date_finish', ['template' => '{input}{error}'])
                        ->widget(\yii\jui\DatePicker::classname(),[
                            'language' => Yii::$app->language,
                            'dateFormat' => 'php:Y-m-d',
                            'options' => ['class' => 'form-control']
                        ]);?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
