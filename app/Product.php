<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products' ;
    protected $primaryKey = 'product_id' ;
    //public $timestamps = false;
    protected $guarded = []; // $guarded = [] to a fillable all columns
    protected $hidden = [
        'pivot'
    ];
    public function Product_description()
    {
        return $this->hasMany('App\Product_description' , 'product_id' , 'product_id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Mcategory' , 'product_to_categories' , 'product_id' , 'category_id');
    }
    public function Stock_status()
    {
        return $this->belongsTo('App\Stock_status' );
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute' , 'product_attributes' , 'product_id' , 'attribute_id')
            ->with('Attribute_description')->withPivot('language_id','text')->select('attributes.attribute_id');
    }
    public function product_discounts()
    {
        return $this->hasMany('App\product_discount' , 'product_id' , 'product_id');
    }
    public function product_specials()
    {
        return $this->hasMany('App\product_special' , 'product_id' , 'product_id');
    }

    public function tax_rate()
    {
        return $this->belongsTo('App\tax_rate' , 'tax_class_id' , 'tax_rate_id' );
    }

    public function Manufacturer()
    {
        return $this->beLongsTo('App\Manufacturer'  , 'manufacturer_id' , 'id' );

    }


// used
   public function getProductAttributes($product_id)
    {
        $product_attribute_data = array();
        $product_attribute_query =  product_attribute::where( 'product_id',$product_id)->select('attribute_id' )->groupby('attribute_id' )->get()->toarray();
        foreach ($product_attribute_query as $product_attribute) {
            $product_attribute_description_data = array();
            $product_attribute_description_query=product_attribute::where( 'product_id',$product_id)->where('attribute_id' ,$product_attribute['attribute_id'])->get();
            foreach ($product_attribute_description_query as $product_attribute_description) {
                $product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
            }

            $product_attribute_data[] = array(
                'attribute_id'                  => $product_attribute['attribute_id'],
                'product_attribute_description' => $product_attribute_description_data
            );
        }
        return $product_attribute_data;
    }

    public function getDetail($id)
    {
        $tableDescription = (new Product_description)->getTable();
        return $this
            ->leftJoin($tableDescription, $tableDescription . '.product_id', $this->getTable() . '.product_id')
            ->where($tableDescription . '.language_id', session('language_id'))
            ->where($this->getTable() . '.product_id' , $id)->first();

    }


    public function getAllProducts()
    {
        $tableDescription = (new Product_description)->getTable();
        return $this
            ->leftJoin($tableDescription, $tableDescription . '.product_id', $this->getTable() . '.product_id')
            ->where($tableDescription . '.language_id', session('language_id'))
            ->where($this->getTable() . '.status' , 1);

    }
    public function getPriceAfterDiscount($quantity =1)
    {
        $discount = $this->discountPrice($quantity);
        if ($discount != -1) {
            return $discount;
        } else {
            return $this->price;
        }
    }
    public function discountPrice($quantity=1)
    {
        $discount= $this->product_discounts()->where('quantity', $quantity)->get()->first();

        if ($discount) {
            if (($discount->date_end >= date("Y-m-d") || $discount->date_end === null)
                && ($discount->date_start <= date("Y-m-d") || $discount->date_start === null)
               ) {
                return $discount->price;
            }
        }

        return -1;
    }
    public function productSpecial()
    {
        $Special = $this->product_specials->first();

        if ($Special) {
            if (($Special['date_end'] >= date("Y-m-d") || $Special['date_end'] === null)
                && ($Special['date_start'] <= date("Y-m-d") || $Special['date_start'] === null)
            ) {
                return $Special['price'];
            }
        }

        return -1;
    }
    public function getFinalPrice($product_id , $quantity)
    {
        $product=$this->getDetail($product_id);
        // special price
        $special=$product->productSpecial();
        if($special != -1){
            $price=$special;
        }else{
            $price=$product->price;
        }
        //  discount price
        $discount=$product->discountPrice($quantity);
        if($discount != -1){
            $price=$discount;
        }
        // price after add tax
        $price=tax_price( $price,$product->getTaxRate());
         return $price;
    }
  public function getTaxRate() {
        $arrTaxList = tax_rate::getListAll();
        if ($this->tax_class_id == 0 || !$arrTaxList->has($this->tax_class_id)) {
            $taxId = 0;
        }else
        {
            $taxId = $this->tax_class_id;
        }

        if ($taxId) {
            $arrRate = tax_rate::getArrayRate();
            return $arrRate[$taxId] ?? 0;
        } else {
            return 0;
        }
    }
    public static function updateQuantity($product_id, $qty_change)
    {
        $item = self::find($product_id);
        if ($item)
        {
            $item->quantity = $item->quantity - $qty_change;
            $item->save();
        }

    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($product) {
            $product->Product_description()->delete();
            $product->product_discounts()->delete();
            $product->product_specials()->delete();
            $product->categories()->detach();
            $product->attributes()->detach();

        });
    }
}
