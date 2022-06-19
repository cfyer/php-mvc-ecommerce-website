<?php

namespace App\Core;

use App\Models\Product;

class Cart
{
    public static function getProductName($id)
    {
        $product = static::getProduct($id);
        return $product->name;
    }

    public static function getProductPrice($id)
    {
        $product = static::getProduct($id);
        return $product->price;
    }

    public static function getProductImage($id)
    {
        $product = static::getProduct($id);
        return $product->image_path;
    }

    public static function getTotalProductPrice($id, $quantity)
    {
        $unit_price = static::getProductPrice($id);
        return $unit_price * $quantity;
    }

    public static function getTotalAmount()
    {
        if (!Session::has('cart')) {
            return 0;
        }
        $total_amount = 0;
        foreach (Session::get('cart') as $item) {
            $total_price = static::getTotalProductPrice($item['id'], $item['quantity']);
            $total_amount += $total_price;
        }
        Session::add('total_amount', $total_amount);
        return $total_amount;
    }

    public static function getProduct($id)
    {
        return Product::where('id', $id)->first();
    }
}
