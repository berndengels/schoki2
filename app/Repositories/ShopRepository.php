<?php
namespace App\Repositories;

use App\Models\ProductSize;
use App\Models\ProductStock;
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
        if (!$cart->content() || $cart->content()->count() < 1) {
            return collect([]);
        }
        return $cart->content()->map(function (CartItem $item) use ($provider, $request) {
            switch ($provider) {
                case 'paypal':
                    return (new PayPalCartItemResource($item));
                case 'stripe':
                    return (new StripeCartItemResource($item));
                default:
                    throw new Exception("No valid payment provider: $provider");
            }
        });
    }

    public static function getStripePriceItems(Cart $cart, Request $request)
    {
        if (!$cart->content() || $cart->content()->count() < 1) {
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

    public static function createOrderByCart(Customer $customer, Cart $cart, int $porto)
    {
        try {
            $content = $cart->content();

            if ($content && $content->count() > 0) {
                $orderItemData = [];
                $total = 0;
                foreach ($content as $item) {
                    $priceTotal = MyMoney::getBrutto($item->price) * $item->qty;
                    $productId  = $item->options['product_id'];
                    $size       = $item->options['size'] ? ProductSize::whereName($item->options['size'])->first() : null;

                    $orderItemData[] = [
                        'size'          => $size ?? null,
                        'product_id'    => $productId,
                        'quantity'      => $item->qty,
                        'price_total'   => $priceTotal,
                    ];
                    $total += $priceTotal;
                    // decrease stocks
                    $stock = ProductStock::whereProductId($productId);
                    if ($size) {
                        $stock->whereProductSizeId($size->id)->first();
                    } else {
                        $stock->whereNull('product_size_id')->first();
                    }
                    if ($stock) {
                        $stock->update(['stock' => $stock->stock - $item->qty]);
                    }
                }

                $params = [
                    'price_total'   => (float) $total,
                    'porto' => $porto / 100,
                ];

                $order = Order::create($params);
                $order->createdBy()->associate($customer);
                $order->orderItems()->createMany($orderItemData);

                return $order;
            }
        } catch (Exception $e) {
            return null;
        }
    }
}
