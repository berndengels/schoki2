<?php
namespace App\Repositories;

use Exception;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;
use App\Http\Resources\Payment\Stripe\PriceResource;
use App\Http\Resources\Payment\PayPal\CartItemResource as PayPalCartItemResource;
use App\Http\Resources\Payment\Stripe\CartItemResource as StripeCartItemResource;
use Illuminate\Http\Request;

class ShopRepository
{
    public static function getCartItems(Cart $cart, $provider, Request $request)
    {
        if(!$cart->content() || $cart->content()->count() < 1) {
            return collect([]);
        }
        return $cart->content()->map(function (CartItem $item) use ($provider, $request) {
            switch($provider) {
                case 'paypal':
                    return (new PayPalCartItemResource($item))->toArray($request);
                case 'stripe':
                    return (new StripeCartItemResource($item))->toArray($request);
                default:
                    throw new Exception("No valid payment provider: $provider");
            }
        });
    }

    public static function getStripePriceItems(Cart $cart, Request $request)
    {
        if(!$cart->content() || $cart->content()->count() < 1) {
            return collect([]);
        }
        return $cart->content()->map(function (CartItem $item) use ($request) {
            return (new PriceResource($item))->toArray($request);
        });
    }

    public static function getCartItemsArray(Cart $cart, $provider, Request $request)
    {
        return self::getCartItems($cart, $provider, $request)->values()->toArray();
    }

    public static function getStripePriceItemsArray(Cart $cart, Request $request)
    {
        return self::getStripePriceItems($cart, $request)->values()->toArray();
    }
}