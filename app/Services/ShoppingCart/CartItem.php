<?php


namespace App\Services\ShoppingCart;

use  Illuminate\Contracts\Support\Arrayable ;
use  Illuminate\Contracts\Support\Jsonable ;
class CartItem implements Arrayable,  Jsonable
{
    /**
     * The rowID of the cart item.
     *
     * @var string
     */
    public $rowId;

    /**
     * The ID of the cart item.
     *
     * @var int|string
     */
    public $id;

    /**
     * The quantity for this cart item.
     *
     * @var int|float
     */
    public $qty;

    /**
     * The name of the cart item.
     *
     * @var string
     */
    public $name;

    /**
     * The price without TAX of the cart item.
     *
     * @var float
     */
    public $price;

    /**
     * The value of tax (%).
     *
     * @var int
     */
    public $tax;

    /**
     * The options for this cart item.
     *
     * @var array
     */
    public $options;

    /**
     * CartItem constructor.
     *
     * @param int|string $id
     * @param string     $name
     * @param float      $qty
     * @param float      $price
     * @param array      $options
     * @param int        $tax
     */
    public function __construct($id, $name,$qty , $price, array $options = [], $tax = 0)
    {

        $this->id       = $id;
        $this->name     = $name;
        $this->price    = floatval($price);
        $this->qty    = floatval($qty);
        $this->tax    = floatval($tax);
        $this->options  =$options;
        $this->rowId = $this->generateRowId($id, $options);;
    }

    /**
     * Create a new instance from the given attributes.
     *
     * @param int|string $id
     * @param string     $name
     * @param float      $qty
     * @param float      $price
     * @param array      $options
     * @param int        $tax
     *  @return CartItem
     */
    public static function getNew($id, $name,$qty , $price, array $options = [], $tax = 0)
    {
        return new self($id, $name,$qty, $price, $options, $tax);
    }
    /**
     * Generate a unique id for the cart item.
     *
     * @param string $id
     * @param array  $options
     * @return string
     */
    protected function generateRowId($id, array $options)
    {
        ksort($options);

        return md5($id . serialize($options));
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        // TODO: Implement toJson() method.
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
