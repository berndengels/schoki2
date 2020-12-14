<?php
namespace App\Repositories;

use App\Events\ProductOrdered;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Shoppingcart;
use Carbon\Carbon;
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

    public static function createOrder(Customer $customer, Cart $cart, $amountReceived, $paid = false) {

        $shoppincart = Shoppingcart::whereIdentifier($customer->getInstanceIdentifier())->first();
        if($cart->count()) {
            if(!$shoppincart) {
                $cart->store($customer->getInstanceIdentifier());
            }
            $orderItemData = [];

            foreach ($cart->content() as $item) {
                $orderItemData[] = [
                    'product_id'    => $item->id,
                    'quantity'      => $item->qty,
                    'price_total'   => $item->total,
                    'paid_on'       => $paid ? Carbon::now('europe/berlin') : null,
                    'amount_received'   => $amountReceived / 100,
                ];
            }
            $params = [
                'price_total'   => (float) $cart->total(),
            ];
            try {
                $order = Order::create($params);
                $order->createdBy()->associate($customer);
                $order->orderItems()->createMany($orderItemData);

                event(new ProductOrdered($order));
                return $order;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
    }
}
