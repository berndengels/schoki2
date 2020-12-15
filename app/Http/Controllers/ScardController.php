<?php
namespace App\Http\Controllers;

use App\Helper\MyMoney;
use App\Models\Customer;
use App\Models\Scard;
use App\Models\Product;
use App\Models\Shoppingcart;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\ScardRequest;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request\Session;

/**
 * Class ScardController
 * @package App\Http\Controllers
 * @todo: remove obsolete shopping cart entries
 */
class ScardController extends Controller
{
    /**
     * @var string
     */
    protected $sessionName = 'scart';

    public function __construct()
    {
        if(!session()->isStarted()) {
            session()->start();
        }

        if(!session()->exists($this->sessionName)) {
            session($this->sessionName, session()->getId());
            session()->put($this->sessionName, session()->getId());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Cart $cart)
    {
        $content = null;
        if($cart->content()->count()) {
            $content = $cart->content();
        }
        return view('public.scard.index', compact('cart','content'));
    }

    public function add(Request $request, Product $product, Cart $cart)
    {
        $cart->add($product, 1);
        $sid = session()->get($this->sessionName);

        if(Shoppingcart::whereIdentifier($sid)->first()) {
            $cart->restore($sid);
        } else {
            $cart->store($sid);
        }

        return redirect()->back();
    }

    public function increment(Request $request, Cart $cart, $rawId)
    {
        /**
         * @var CartItem $item
         */
        $sid = session()->get($this->sessionName);
        $cart->update($rawId, $cart->get($rawId)->qty + 1);
        $cart->restore($sid);
        return redirect()->back();
    }

    public function decrement(Request $request, Cart $cart, $rawId)
    {
        /**
         * @var CartItem $item
         */
        $sid = session()->get($this->sessionName);
        $cart->update($rawId, $cart->get($rawId)->qty - 1);
        $cart->restore($sid);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Cart $cart)
    {
        $sid = session()->get($this->sessionName);
        $cart->destroy();
        Shoppingcart::whereIdentifier($sid)->delete();
        return redirect()->route('public.events');
    }
}
