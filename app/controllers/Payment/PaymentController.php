<?php

namespace App\Controllers\Payment;

use App\Controllers\Controller;
use App\Core\Cart;
use App\Core\Request;
use App\Core\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Payment\PaymentService;
use App\Payment\Requests\IDPayRequest;
use App\Payment\Requests\IDPayVerifyRequest;

class PaymentController extends Controller
{
    public function pay()
    {
        $this->checkUserLoggedIn();
        $this->chackCartIsNotEmpty();

        $user = User::where('id', Session::get('SESSION_USER_ID'))->first();

        try {
            $cart = Session::get('cart');

            $ref_code = base64_encode(openssl_random_pseudo_bytes(32));

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => Cart::getTotalAmount(),
                'status' => 'unpaid',
                'ref_code' => $ref_code
            ]);

            foreach ($cart as $item) {
                $product = Product::where('id', $item['id'])->first();
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'unit_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total_price' => $product->price * $item['quantity'],
                ]);
            }

            $payment = Payment::create([
                'order_id' => $order->id,
                'ref_id' => rand(1111, 9999),
                'res_id' => rand(1111, 9999),
                'status' => 'unpaid',
            ]);

            $idpayRequest = new IDPayRequest(Cart::getTotalAmount(), $user, $order->id);

            $paymentService = new PaymentService(PaymentService::IDPAY, $idpayRequest);

            return $paymentService->pay();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    protected function checkUserLoggedIn()
    {
        if (Session::has('SESSION_USER_ID') && Session::has('SESSION_USER_NAME')) {
            return true;
        }

        return redirect('/login');
    }

    protected function chackCartIsNotEmpty()
    {
        if (is_null(Session::get('cart'))) {
            return redirect('/');
        }

        return true;
    }

    public function callback()
    {
        $request = Request::get('post');
        $idpayVerifyRequest = new IDPayVerifyRequest($request->id, $request->order_id);
        $paymentService = new PaymentService(PaymentService::IDPAY, $idpayVerifyRequest);
        $result = $paymentService->verify();

        if (!$result or $result['status'] != 100) {
            Session::add('payment', 'Payment failed');
            return redirect('/cart');
        }

        Order::where('id', $result['order_id'])->update([
            'status' => 'paid'
        ]);

        Payment::where('order_id', $result['order_id'])->update([
            'status' => 'paid'
        ]);

        foreach (Session::get('cart') as $item) {
            $this->decreaseQuantityAfterPayment($item);
        }

        Session::remove('cart');
        Session::add('payment', 'Payment was successful');
        return redirect('/cart');
    }

    private function decreaseQuantityAfterPayment($item)
    {
        $product = Product::where('id', $item['id'])->first();
        $product->update([
            'quantity' => $product->quantity - $item['quantity']
        ]);
    }
}
