<?php
$form = \yii\bootstrap\ActiveForm::begin(['layout' => 'horizontal']);
echo $form->field($book, 'title');
echo $form->field($book, 'author_id')->dropDownList(
    \yii\helpers\ArrayHelper::map($authors, 'id', 'fullName')
);
?>
    <div class="form-group field-book-date_created">
        <label class="control-label col-sm-3" for="book-date_created">Дата выхода книги </label>

        <div class="col-sm-6">
            <?= \yii\jui\DatePicker::widget([
                'model' => $book,
                'attribute' => 'date_created',
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]); ?>
        </div>

    </div>
<?php
echo \yii\bootstrap\Button::widget([
    'label' => 'Сохранить',
    'options' => [
        'class' => 'col-md-offset-3',
    ],
]);
?>