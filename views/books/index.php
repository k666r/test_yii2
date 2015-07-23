<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <?php
    $form = \yii\bootstrap\ActiveForm::begin([
        'layout' => 'inline',
        'options' => [
            'id' => 'books_filter_form',
        ],
        'action' => Url::to(['books/index']),
        'method' => 'GET',
    ]);
    ?>
    <div class="col-md-3">
        <?php
        echo $form->field($filterModel, 'author_id')
            ->dropDownList(
                \yii\helpers\ArrayHelper::map(
                    $authors, 'id', 'fullName'
                ),
                [
                    'prompt' => 'автор',
                ]
            );
        ?>
    </div>
    <div class="col-md-3">
        <?php
        echo $form->field($filterModel, 'title', ['inputOptions' => ['placeholder' => 'название книги'],]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <?php
        echo Html::tag('label', 'Дата выхода книги:', []);
        ?>
    </div>
    <div class="col-md-2">
        <?php
        echo \yii\jui\DatePicker::widget([
            'model' => $filterModel,
            'attribute' => 'date_created_from',
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
        ]);
        ?>
    </div>
    <div class="col-md-1">
        <?php
        echo Html::tag('label', 'до');
        ?>
    </div>
    <div class="col-md-2">
        <?php
        echo \yii\jui\DatePicker::widget([
            'model' => $filterModel,
            'attribute' => 'date_created_to',
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
        ]);
        ?>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-2">
        <?php
        echo \yii\bootstrap\Button::widget([
            'label' => 'искать',
        ]);
        echo Html::a('Добавить', Url::to(['books/create']), ['class' => 'btn btn-default']);
        ?>
    </div>
</div>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        [
            'attribute' => 'preview',
            'format' => 'html',
            'value' => function ($data) {
                $image = Html::img($data->preview, [
                    'height' => '50px',
                    'data-index' => $data->id,
                    'class' => 'modal_image',
                ]);
                return $image;
            },
        ],
        'authorName',
        'date_created',
        'date_added',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{update} {view} {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    $id = 'view_' . $model->id;
                    return \yii\bootstrap\Modal::widget([
                        'id' => $id,
                        'toggleButton' => [
                            'label' => '',
                            'tag' => 'a',
                            'href' => $url,
                            'data-target' => '#' . $id,
                            'class' => 'glyphicon glyphicon-eye-open',
                        ]
                    ]);
                },
                'update' => function ($url, $model, $key) use ($getArray) {
                    return Html::a('', Url::to([
                        'books/update',
                        'id' => $model->id,
                        'filtredModel' => $getArray,
                    ]), [
                        'class' => 'glyphicon glyphicon-pencil',
                    ]);
                },

            ],

        ],

    ],
]);

?>
<div id="modal_image_dialog" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <img id="modal_image_body">
        </div>
    </div>
</div>