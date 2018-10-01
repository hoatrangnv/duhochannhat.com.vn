<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/2/2018
 * Time: 1:24 AM
 */

namespace frontend\controllers;


use common\models\Contact;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class ApiController extends Controller
{
    public function actionSaveNewContact() {
        if (!\Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid Request. Request must be POST.');
        }

        $contact = new Contact();

        $contact->title = \Yii::$app->request->post('title');
        $contact->customer_name = \Yii::$app->request->post('customer_name');
        $contact->customer_phone = \Yii::$app->request->post('customer_phone');
        $contact->type = \Yii::$app->request->post('type');
        $contact->status = Contact::STATUS__NEW;

        if ($contact->save()) {
            return 'success';
        } else {
            return $contact->errors;
        }
    }
}