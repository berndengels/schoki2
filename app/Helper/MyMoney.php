<?php
namespace App\Helper;

class MyMoney
{
    public static function getDivisor()
    {
        $tax = (int) config('my.payment.tax');
        return (100 + $tax)/100;
    }

    public static function getNetto($brutto, $decimal = 2)
    {
        $divisor = self::getDivisor();
        return round($brutto / $divisor, $decimal);
    }

    public static function getBrutto($netto, $decimal = 2)
    {
        $divisor = self::getDivisor();
        return round($netto * $divisor, $decimal);
    }
}
