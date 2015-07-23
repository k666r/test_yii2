<?php

namespace app\controllers;


use app\models\Author;
use app\models\Book;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;

class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $filterModel = new Book();
        if (Yii::$app->request->get('Book')) {
            $filterModel->load(Yii::$app->request->get());
        }
        $getArray = Yii::$app->request->get();
        $getArray['Book'] = $filterModel->getArrayForLink();
        $this->_registerJs();
        return $this->render('index', [
                'dataProvider' => $filterModel->search(),
                'filterModel' => $filterModel,
                'authors' => Author::find()->all(),
                'getArray' => $getArray,
            ]
        );
    }

    private function _registerJs()
    {
        $view = $this->getView();
        $js = "
        $('.modal_image').on('click', function () {
            $('#modal_image_body').attr('src',$(this).attr('src'));
            $('#modal_image_dialog').modal('show');
        });
        ";
        $view->registerJs($js);
    }

    public function actionCreate()
    {
        $book = new Book();
        if (Yii::$app->request->isPost) {
            $book->load(Yii::$app->request->post());
            $book->save();
            $this->redirect(Url::to(['books/index']));
        }
        return $this->render('create', [
            'book' => $book,
            'authors' => Author::find()->all(),
        ]);
    }

    public function actionView($id)
    {
        $book = Book::findOne(['id' => $id]);
        return $this->renderAjax('view', [
            'book' => $book,
        ]);
    }

    public function actionUpdate($id)
    {
        $book = Book::findOne(['id' => $id]);
        $filtredModel = Yii::$app->request->get('filtredModel');
        if (Yii::$app->request->isPost) {
            $book->load(Yii::$app->request->post());
            $book->save();
            $this->redirect(Url::to(array_merge(['books/index'], $filtredModel)));
        }
        return $this->render('update', [
            'book' => $book,
            'authors' => Author::find()->all(),
            'Book' => $filtredModel
        ]);
    }

    public function actionDelete($id)
    {
        $book = Book::findOne(['id' => $id]);
        if ($book) {
            $book->delete();
        }
        $this->redirect(Url::to(['books/index']));
    }
}