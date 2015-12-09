<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-9">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'author_id',
                        'value' => $model->author->fullname,
                    ],
                    'name',
                    'date_create:date',
                    'date:date',
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?php echo Html::img($model->image->real_path, ['width' => "100%", "height" => "auto"])?>
        </div>
    </div>
</div>
