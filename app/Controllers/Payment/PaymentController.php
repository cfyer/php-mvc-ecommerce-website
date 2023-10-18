<?php

namespace App\Controllers\Payment;

use App\Controllers\Controller;
use App\Payment\Exceptions\GatewayNotFoundException;
use App\Core\{Cart, Session, Request};
use Exception;
use App\Models\{Order, OrderItem, Payment, Product, User};
use App\Payment\PaymentService;
use App\Payment\Requests\{IDPayRequest, IDPayVerifyRequest};

class PaymentController extends Controller
{
    public function pay()
    {
        $this->checkUserLoggedIn();
        $this->checkCartIsNotEmpty();

        $user = User::query()->where('id', Session::get('SESSION_USER_ID'))->first();

        try {
            $cart = Session::get('cart');

            $ref_code = base64_encode(openssl_random_pseudo_bytes(32));

            $order = Order::query()->create([
                'user_id' => $user->id,
                'total_price' => Cart::getTotalAmount(),
                'status' => 'unpaid',
                'ref_code' => $ref_code
            ]);

            foreach ($cart as $item) {
                $product = Product::query()->where('id', $item['id'])->first();

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'unit_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total_price' => $product->price * $item['quantity'],
                ]);
            }

            Payment::query()->create([
                'order_id' => $order->id,
                'ref_id' => rand(1111, 9999),
                'res_id' => rand(1111, 9999),
                'status' => 'unpaid',
            ]);

            $idpayRequest = new IDPayRequest(Cart::getTotalAmount(), $user, $order->id);

            $paymentService = new PaymentService(PaymentService::IDPAY, $idpayRequest);

            return $paymentService->pay();
        } catch (Exception $e) {
            die($e->getMessage() . ' : line' . $e->getLine());
        }
    }

    protected function checkUserLoggedIn(): void
    {
        if (!(Session::has('SESSION_USER_ID') && Session::has('SESSION_USER_NAME'))) {
            redirect('/login');
        }
    }

    protected function checkCartIsNotEmpty(): void
    {
        if (is_null(Session::get('cart'))) {
            redirect('/');
        }
    }

    /**
     * @throws GatewayNotFoundException
     */
    public function callback(): void
    {
        $request = Request::get('post');
        $idpayVerifyRequest = new IDPayVerifyRequest($request->id, $request->order_id);
        $paymentService = new PaymentService(PaymentService::IDPAY, $idpayVerifyRequest);
        $result = $paymentService->verify();

        if (!$result or $result['status'] != 100) {
            Session::add('payment', 'Payment failed');
            redirect('/cart');
        }

        Order::query()->where('id', $result['order_id'])->update(['status' => 'paid']);

        Payment::query()->where('order_id', $result['order_id'])->update(['status' => 'paid']);

        foreach (Session::get('cart') as $item) {
            $this->decreaseQuantityAfterPayment($item);
        }

        Session::remove('cart');
        Session::add('payment', 'Payment was successful');
        redirect('/cart');
    }

    private function decreaseQuantityAfterPayment($item)
    {
        $product = Product::query()->where('id', $item['id'])->first();
        $product->update([
            'quantity' => $product->quantity - $item['quantity']
        ]);
    }
}
