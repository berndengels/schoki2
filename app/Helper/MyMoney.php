<?php
namespace App\Helper;

use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Contracts\Calculator;

class MyMoney implements Calculator
{
    public static function getDivisor()
    {
        $tax = (int) config('my.payment.tax');
        return (100 + $tax)/100;
    }

    public static function getNetto($brutto)
    {
        $divisor = self::getDivisor();
        return $brutto / $divisor;
    }

    public static function getRounded($val)
    {
        return round($val) * 100 / 100;
    }

    public static function getNettoRounded($val, $decimal = 2)
    {
        $tmp = round(self::getNetto($val), 3);
        return round($tmp, $decimal);
    }

    public static function getBrutto($netto, $decimal = 2)
    {
        $divisor = self::getDivisor();
        return round($netto * $divisor, $decimal);
    }

    public static function getAttribute(string $attribute, CartItem $cartItem)
    {
        $decimals = config('cart.format.decimals', 2);

        switch ($attribute) {
            case 'discount':
                return $cartItem->price * ($cartItem->getDiscountRate() / 100);
            case 'tax':
                return round($cartItem->priceTarget * ($cartItem->taxRate / 100), $decimals);
            case 'priceTax':
                return round($cartItem->priceTarget + $cartItem->tax, $decimals);
            case 'discountTotal':
                return round($cartItem->discount * $cartItem->qty, $decimals);
            case 'priceTotal':
                return round($cartItem->price * $cartItem->qty, $decimals);
            case 'subtotal':
                return max(round($cartItem->priceTotal - $cartItem->discountTotal, $decimals), 0);
            case 'priceTarget':
                return round(($cartItem->priceTotal - $cartItem->discountTotal) / $cartItem->qty, $decimals);
            case 'taxTotal':
                return round($cartItem->subtotal * ($cartItem->taxRate / 100), $decimals);
            case 'total':
                return round($cartItem->subtotal + $cartItem->taxTotal, $decimals);
            default:
                return;
        }
    }
}
