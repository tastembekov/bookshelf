<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            [
                'attribute' => 'author_id',
                'value' => function($model)
                {
                    return $model->author->fullname;
                }
            ],
            'name',
            'image_id',
            [
                'attribute' => 'image_id',
                'format' => 'html',
                'value' => function($model)
                {
                    return Html::a(Html::img($model->image->preview_path, ['width' => '50px', 'height' => 'auto']),
                        '#', ['class' => 'image-view-link']);
                }
            ],
            'date:date',
            'date_create:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                            'class' => 'book-view-link',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>

<?php Modal::begin([
    'id' => 'book-modal',
    'header' => Yii::t('yii', 'View'),
    'footer' => Html::a(Yii::t('app', 'Close'), '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
]); ?>
    <div class="well"></div>
<?php Modal::end(); ?>


