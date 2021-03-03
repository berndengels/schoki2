<?php
namespace App\Http\Resources\Payment\Stripe;

use Gloudemans\Shoppingcart\Cart;

class PortoPrice
{
    protected static $price = 300;
    protected static $minPorto = 300;
    protected static $maxPorto = 500;
    protected static $maxQuantity = 3;

    /**
     * @return array
     */
    public static function get(Cart $cart)
    {
        $quantity = 0;
        $cart->content()->map(function ($item) use (&$quantity) {
            $quantity += $item->qty;
        });

        if ($quantity >= self::$maxQuantity) {
            self::$price = self::$maxPorto;
        }
        return [
            'unit_amount'   => self::$price,
            'currency'      => 'eur',
            'product_data'  => [
                'name'  => 'Porto Versandkosten',
            ],
        ];
    }
}
