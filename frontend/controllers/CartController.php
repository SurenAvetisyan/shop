<?php

namespace frontend\controllers;
use common\models\Cart;
use common\models\Products;
use frontend\models\OrderForm;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\User;

class CartController extends Controller
{
    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest){
            return $this->redirect('/');
        }
        return parent::beforeAction($action);
    }


    public function actionAddToCart(){

        $id = \Yii::$app->request->post('id');
        $qty = \Yii::$app->request->post('qty');
        $product = Products::findOne($id);
        $stockQty = $product->stock;

        if(\Yii::$app->user->isGuest){
            return json_encode(['error' => 'Please Login to your account to be able to add products!']);
        }else{
            if(!empty($id) && !empty($qty) && $stockQty != 0){
                $user = \Yii::$app->user->id;
                $stockQty = $stockQty - $qty;
                $product->stock = $stockQty;
                $product->save(false);
                if(!empty($product)){
                    $errors = [];
                    $cart = Cart::findOne(['product_id'=>$product->id,'user_id'=>$user]);
                    if(!empty($cart)){
                        $cart ->qty += $qty;
                        $cart->save(false);
                    }else{
                        $new_cart = new Cart();
                        $new_cart->product_id = $product->id;
                        $new_cart->qty = $qty;
                        $new_cart->user_id = $user;
                        if(!$new_cart->save()){
                            $errors[] = $new_cart->errors;
                        }
                    }

                    return true;

                }
            }
        }
    }

    /**
     *  $cart_id
     *
     *  return mixed
     */



    public function actionRemove(){
        $cart_id = \Yii::$app->request->post('id');
        if(!empty($cart_id)){
            $cart = Cart::findOne($cart_id);
            if(!empty($cart)){
                if($cart->delete()){
                    return true;
                }
            }else{
                return 'no such product in cart';
            }

        }else{
            return 'no such product in cart';
        }


    }

    /**
     *  $cart_id
     *  $qty
     *  return mixed
     */

    public function actionChangeProductCount(){
        $data = \Yii::$app->request->post();
        //$qty = \Yii::$app->request->post('qty');


        if (!empty($data['id'])) {
            $cart = Cart::findOne($data['id']);


            if (!empty($cart)) {
                if ($data['action'] == 'minus'){
                    if ($cart->qty > 0){
                        $cart->qty -= 1;
                        if ($cart->qty == 0){
                            $cart->delete();
                            return json_encode(['qty' => 0]);
                        }

                        $product = Products::findOne($cart->product_id);
                        $cart->update(true,['qty']);
                        $sub_total = (float)$product->price * (int)$cart->qty;
                        $items = Cart::find()->with('product')->where(['user_id'=>$cart->user_id])->asArray()->all();
                        $total = $this->calculateTotal($items);

                        return json_encode(['qty' => $cart->qty,'sub_total' => $sub_total,'total' => $total]);

                    }else{

                        return json_encode(['qty' => 0]);
                    }

                }elseif($data['action'] == 'plus'){
                    $cart->qty +=1;
                    $cart->update(true,['qty']);
                    $product = Products::findOne($cart->product_id);
                    $sub_total = (float)$product->price * (int)$cart->qty;
                    $items = Cart::find()->with('product')->where(['user_id'=>$cart->user_id])->asArray()->all();
                    $total = $this->calculateTotal($items);
                    return json_encode(['qty' => $cart->qty,'sub_total' => $sub_total,'total' => $total]);

                }elseif ($data['action'] == 'change'){
                    $cart->qty = (int) \Yii::$app->request->post('qty', 0);
                    if ($cart->qty == 0){
                        $cart->delete();
                        return json_encode(['qty' => 0]);
                    }
                    $cart->update(false, ['qty'] );


                    $product = Products::findOne($cart->product_id);
                    $sub_total = (float)$product->price * (int)$cart->qty;
                    $items = Cart::find()->with('product')->where(['user_id'=>$cart->user_id])->asArray()->all();
                    $total = $this->calculateTotal($items);
                    return json_encode([
                        'qty' => $cart->qty,
                        'sub_total' => $sub_total,
                        'total' => $total
                    ]);

                }
            }
        }
        return false;
    }

    private function calculateTotal($cart){

        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $total+= ($item['product']['price'] * $item['qty']);
            }
        }
        return $total;
    }

    public function actionCheckout(){

        $id = \Yii::$app->user->id;
        $cart = Cart::find()->with('product')->where(['user_id'=>$id])->asArray()->all();

        $model = new OrderForm();

        return $this->render('checkout',[
            'cart' => $cart,
            'model' => $model
        ]);
    }

    public function actionOrder(){

        $post = \Yii::$app->request->post();
        $cart_products = [];
        $id = \Yii::$app->user->id;
        $cart = Cart::find()->with('product')->where(['user_id'=>$id])->asArray()->all();
        $message = '';
        if ($cart) {
            foreach ($cart as $item) {
                $product = $item['product'];

                if(!empty($product)){
                    $singl_product = Products::findOne($product['id']);

                    if($singl_product){
                        if($singl_product->stock <  $item['qty']){
                            $message .= \Yii::t('app','"{product}" product has {qty} stock. So you will get only {qty} from {ordered}',[
                                'product' => $singl_product->title,
                                'qty' => $singl_product->stock,
                                'ordered' => $item['qty']
                            ])."<br>";
                            $item['qty'] = $singl_product->stock;


                        }
                        array_push($cart_products,$item);
                    }
                }
            }
        }

        $email = \Yii::$app->params['adminEmail'];
        $from = $post['OrderForm']['email'];

        $from_name = $post['OrderForm']['full_name'];
        try{
            \Yii::$app->mailer->compose('checkout-html',[
                'cart' => $cart_products,
                'data'=>$post['OrderForm'],
                'note' => $message,
                'shop_to' => \Yii::$app->request->post()
            ])->setTo($email)

                ->setFrom([$from => $from_name])
                ->setSubject('Product checkout')
                ->send();

            \Yii::$app->mailer->compose('checkout-html',[
                'cart' => $cart_products,
                'data'=>$post['OrderForm'],
                'note' => $message,
                'shop_to' => \Yii::$app->request->post()
            ])->setTo($from)

                ->setFrom([$email => 'Yii shop'])
                ->setSubject('Product checkout')
                ->send();

            \Yii::$app->session->setFlash('mail_sent','Order succefully sent!');

            if ($cart) {
                foreach ($cart as $item) {
                    $product = $item['product'];
                    if(!empty($product)){
                        $singl_product = Products::findOne($product['id']);
                        if($singl_product){
                            if($singl_product->stock <  $item['qty']){
                                $item['qty'] = $singl_product->stock;
                            }
                            $singl_product->stock -= $item['qty'];
                            $singl_product->save(false);
                        }
                    }
                }
            }
            Cart::deleteAll(['user_id'=>$id]);
            return $this->redirect(['checkout']);
        }catch (\Swift_TransportException $e){

            \Yii::$app->session->setFlash('mail_sent','Something went wrong. Please try later');

            return $this->redirect(['checkout']);
        }
    }

}