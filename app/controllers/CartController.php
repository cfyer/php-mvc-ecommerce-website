<?php

namespace App\Controllers;

use App\Core\{Request, Session, View};
use App\Models\Product;

class CartController extends Controller
{
    public function show(): View
    {
        $cartItems = Session::get('cart');

        return View::render()->blade('client.cart.show', compact('cartItems'));
    }

    public function addItem()
    {
        $request = Request::get('post');
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($_SESSION['cart'][$id])) {
            exit("1");
        } else {
            $_SESSION['cart'][$id] = ['id' => $id, 'quantity' => $quantity];
        }

        return 0;
    }

    public function incQty()
    {
        $id = Request::get('post')->id;
        $product = Product::where('id', $id)->first();
        if ($product['quantity'] <= $_SESSION['cart'][$id]['quantity']) {
            exit();
        }
        $_SESSION['cart'][$id]['quantity']++;
        return true;
    }

    public function decQty(): bool
    {
        $id = Request::get('post')->id;
        if ($_SESSION['cart'][$id]['quantity'] <= 1) {
            unset($_SESSION['cart'][$id]);
            return true;
        }
        $_SESSION['cart'][$id]['quantity']--;
        return true;
    }

    public function getCartItems()
    {
        return Session::get('cart');
    }

    public function removeItem(): void
    {
        $id = Request::get('post')->id;
        unset($_SESSION['cart'][$id]);
    }

    public function removeAll(): void
    {
        Session::remove('cart');
        Session::add('cart', []);
    }
}
