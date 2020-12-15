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
    /**
     * @var string
     */
    protected $sid;

    public function __construct()
    {
        if(!session()->isStarted()) {
            session()->start();
        }

        if(!session()->exists($this->sessionName)) {
            session($this->sessionName, session()->getId());
            session()->put($this->sessionName, session()->getId());
        }
        $this->sid = session()->get($this->sessionName);
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

    public function add(Product $product, Cart $cart)
    {
        $cart->add($product, 1);

        if(Shoppingcart::whereIdentifier($this->sid)->first()) {
            $cart->restore($this->sid);
        } else {
            $cart->store($this->sid);
        }

        return redirect()->back();
    }

    public function increment(Cart $cart, $rawId)
    {
        $cart->update($rawId, $cart->get($rawId)->qty + 1);
        $cart->restore($this->sid);
        return redirect()->back();
    }

    public function decrement(Cart $cart, $rawId)
    {
        $cart->update($rawId, $cart->get($rawId)->qty - 1);
        $cart->restore($this->sid);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cart  $cart
     * @return Response
     */
    public function delete(Cart $cart, $rawId)
    {
        $cart->remove($rawId);
        $cart->restore($this->sid);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cart  $cart
     * @return Response
     */
    public function destroy(Cart $cart)
    {
        $cart->destroy();
        Shoppingcart::whereIdentifier($this->sid)->delete();
        return redirect()->route('public.events');
    }
}
