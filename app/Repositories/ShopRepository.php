<?php
namespace App\Repositories;

use Exception;
use App\Models\Order;
use App\Helper\MyMoney;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Events\ProductOrdered;
use App\Models\Shoppingcart;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;
use App\Http\Resources\Payment\Stripe\PriceResource;
use App\Http\Resources\Payment\PayPal\CartItemResource as PayPalCartItemResource;
use App\Http\Resources\Payment\Stripe\CartItemResource as StripeCartItemResource;

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

    public static function createOrderByCart( Customer $customer, Cart $cart ) {
        try {
            $content = $cart->content();

            if($content && $content->count() > 0) {
                $orderItemData = [];
                $total = 0;
                foreach ($content as $item) {
                    $priceTotal = MyMoney::getBrutto($item->price) * $item->qty;
                    $orderItemData[] = [
                        'product_id'    => $item->id,
                        'quantity'      => $item->qty,
                        'price_total'   => $priceTotal,
                    ];
                    $total += $priceTotal;
                }

                $params = [
                    'price_total'   => (float) $total
                ];

                $order = Order::create($params);
                $order->createdBy()->associate($customer);
                $order->orderItems()->createMany($orderItemData);

                $cart->destroy();

                event(new ProductOrdered($order));

                return $order;
            }
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function updateOrder( array $params, int $orderId)
    {
        try {
            $order = Order::whereId($orderId)->first();
            if($order) {
                return $order->update($params);
            }
            return null;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
