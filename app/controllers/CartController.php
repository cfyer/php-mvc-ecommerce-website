<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Session;
use App\Core\View;

class CartController
{
    public function show()
    {
        $cartItems = Session::get('cart');
        return View::blade('client.cart.show', compact('cartItems'));
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
        $_SESSION['cart'][$id]['quantity']++;
        return true;
    }

    public function decQty()
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

    public function removeItem()
    {
        $id = Request::get('post')->id;
        unset($_SESSION['cart'][$id]);
        return true;
    }

    public function removeAll()
    {
        Session::remove('cart');
        Session::add('cart', []);
        return true;
    }
}
