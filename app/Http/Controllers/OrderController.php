<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Http\Requests\CustomerRequest;
use App\Models\Order;
use App\Models\Shoppingcart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\OrderRequest;
use Gloudemans\Shoppingcart\Cart;

class OrderController extends Controller
{
    public function __contsruct() {
    }

    public function create(Cart $cart) {
        $this->middleware('auth');
        /**
         * @var User $user
         */
        $user = auth('web')->user();
        $customer = $user->createOrGetStripeCustomer();

        return view('public.order.create', compact('cart','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Cart $cart)
    {
        /**
         * @var User $user
         */
        $user = auth('web')->user();

        $shoppincart = Shoppingcart::whereIdentifier($user->getInstanceIdentifier())->first();
        if($cart->count()) {
            if(!$shoppincart) {
                $cart->store($user->getInstanceIdentifier());
            }
            $orderItemData = [];

            foreach ($cart->content() as $item) {
                $orderItemData[] = [
                    'product_id'    => $item->id,
                    'quantity'      => $item->qty,
                    'price_total'   => (float) ($item->price * $item->qty),
                ];
            }
            $params = [
                'price_total'   => (float) $cart->priceTotal(),
            ];
//            dd($orderItemData);
            try {
                $order = Order::create($params);
                $order->createdBy()->associate($user);
                $order->orderItems()->createMany($orderItemData);
//                $order->save();

                $cart->destroy();

                event(new ProductOrdered($order));
                return view('public.order.store', compact('order'));
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            // remove shopping cart entries
            // @todo: redirect to order detail confirmation page
            // @todo: payment stuff
            // trigger Order Event
        }
//        return redirect()->route('public.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
}
