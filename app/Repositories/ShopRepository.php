<?php
namespace App\Repositories;

use App\Helper\MyMoney;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
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

    public static function createOrder(
        Customer $customer,
        int $amountReceived,
        int $created,
        bool $paid,
        string $paymentId,
        string $paymentType
    ) {

        try {
            /**
             * @var Shoppingcart $shoppincart
             */
            $shoppingCart   = Shoppingcart::whereIdentifier($customer->getInstanceIdentifier())->first();
            $content        = $shoppingCart ? unserialize($shoppingCart->content) : null;

            if($content && $content->count() > 0) {
                $orderItemData = [];
                $total = 0;
                foreach ($content as $item) {
                    $priceTotal = MyMoney::getBrutto($item->price) * $item->qty;
                    $orderItemData[] = [
                        'product_id'    => $item->id,
                        'quantity'      => $item->qty,
                        'price_total'   => $priceTotal,
                        'amount_received'   => $amountReceived / 100,
                    ];
                    $total += $priceTotal;
                }

                $params = [
                    'paid_on'           => $paid ? Carbon::createFromTimestamp($created) : null,
                    'price_total'       => (float) $total,
                    'amount_received'   => $amountReceived,
                    'payment_id'        => $paymentId,
                    'payment_type'      => $paymentType,
                ];
                $foundOrder = Order::wherePaymentId($paymentId)->first();
                if($foundOrder) {
                    $order = $foundOrder->update($params);
                    $order->updatedBy()->associate($customer);
                } else {
                    $order = Order::create($params);
                    $order->createdBy()->associate($customer);
                }
                $order->orderItems()->createMany($orderItemData);

                Cart::destroy();
                Shoppingcart::whereIdentifier($customer->getInstanceIdentifier())->delete();

                event(new ProductOrdered($order));

                return $order;
            }
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
