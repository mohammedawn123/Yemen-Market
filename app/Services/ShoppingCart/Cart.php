<?php


namespace App\Services\ShoppingCart;

use App\Product;
use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class Cart
{
    const DEFAULT_INSTANCE = 'default';
    private $session;
    private $instance;
    private $events;
    /**
     * Cart constructor.
     *
     * @param \Illuminate\Session\SessionManager      $session
     *  @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function __construct(SessionManager $session ,Dispatcher $events)
    {
        $this->session = $session;
        $this->events = $events;
        $this->instance(self::DEFAULT_INSTANCE);
    }

    public function instance($instance = null)
    {

        $instance = $instance ?: self::DEFAULT_INSTANCE;

        $this->instance = sprintf('%s.%s', 'cart', $instance);
        return $this;
    }

    public  function add($id, $name = null, $qty = null, $price = null, array $options = [], $tax = 0)
    {
        $content =  $this->getContent();
        if($content->has($id))
        {
            $qty=$content->pull($id)->qty + $qty ;

        }
        $cartitem= $this->createCartItem($id, $name, $qty, $price, $options, $tax);
        $content->put($cartitem->id, $cartitem);
        $this->session->put($this->instance, $content);
        return $cartitem;
    }


    public function update($instance, $content)
    {
        $this->session->put($instance, $content);
    }
        public function remove($id)
    {
        $cartItem = $this->get($id);

        $content = $this->getContent();

        $content->pull($cartItem->id);
        $this->session->put($this->instance, $content);
    }
    /**
     * Create a new CartItem from the supplied attributes.
     *
     * @param mixed     $id
     * @param mixed     $name
     * @param int|float $qty
     * @param float     $price
     * @param array     $options
     * @param int        $tax
     * @return CartItem
     */
    private function createCartItem($id, $name, $qty, $price, array $options, $tax = 0)
    {

            $cartItem = CartItem::getNew($id, $name,$qty, $price, $options, $tax);

        return $cartItem;
    }
    /**
     * Get the carts content, if there is no cart content set yet, return a new empty Collection
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getContent()
    {
        $content = $this->session->has($this->instance)
            ? $this->session->get($this->instance)
            : new Collection;

        return $content;
    }

    /**
     * Get a cart item from the cart by its $id.
     *
     * @param string $id
     * @return \App\Services\ShoppingCart\CartItem
     */
    public function get($id)
    {
        $content = $this->getContent();

        if (!$content->has($id)) {
            return;
        }

        return $content->get($id);
    }

    /**
     * Destroy the current cart instance.
     *
     * @return void
     */
    public function destroy()
    {
        $this->session->remove($this->instance);
    }
    /**
     * Get the content of the cart.
     *
     * @return \Illuminate\Support\Collection
     */
    public function content()
    {
        if (is_null($this->session->get($this->instance))) {
            return new Collection([]);
        }

        return $this->session->get($this->instance);
    }
    public function count()
    {
        $content = $this->getContent();

        return $content->sum('qty');
    }


    /**
     * Get the total price of the items in the cart.
     *
     * @return string
     */
    public function total()
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, CartItem $cartItem) {
            return $total + ($cartItem->qty * tax_price($cartItem->price, $cartItem->tax));
        }, 0);
        return $total;
    }

    /**
     * Get the subtotal of the items in the cart.
     *
     * @return float
     */
    public function subtotal()
    {
        $content = $this->getContent();

        $subTotal = $content->reduce(function ($subTotal, CartItem $cartItem) {
            return $subTotal + ($cartItem->qty * $cartItem->price);
        }, 0);
        return $subTotal;
    }

    /*
     Get list Cart
     */
    public static function getListCart($instance = self::DEFAULT_INSTANCE)
    {
        $cart = \Cart::instance($instance);
        $arrCart['count'] = $cart->count();
        $arrCart['subtotal'] = currency_symbol($cart->subtotal());
        $arrCart['total'] = currency_symbol($cart->total());
        $arrCart['items'] = [];
        if ($cart->count()) {
            foreach ($cart->content() as $key => $item) {
                $product =(new Product)->getDetail($item->id);
                $arrCart['items'][] = [
                    'id' => $item->id,
                    'qty' => $item->qty,
                    'image' => image_thumbnail($product->image),
                    'price' => $product->getPriceAfterDiscount(),
                    'showPrice' => $product->price,
                    'tax' =>  $item->tax,
                    'url' => 'ddddddd',
                    'name' => $product->name,
                ];
            }
        }

        return $arrCart;
    }
}
