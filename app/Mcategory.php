<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mcategory extends Model
{

    protected $fillable = [
        'category_id' ,'id', 'parent_id', 'top', 'column','status' ,'image' , 'sort_order'
    ];
    public $table = 'mcategories';
    protected $primaryKey = 'category_id' ;
    protected $hidden = [
       'pivot'
    ];
    public function Category_description()
    {
    	return $this->hasMany('App\Category_description' , 'category_id' ,'category_id');
    }
 public function Parent_category()
    {
        return $this->hasMany('App\Category_description' , 'category_id' , 'parent_id');
    }
    public function childs_of_category()
    {
        return $this->hasMany('App\Mcategory' , 'parent_id' , 'category_id')->with('Category_description');
    }
    public function Categorypath()
    {
    	return $this->hasMany('App\Category_path' , 'category_id' , 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product' , 'product_to_categories' , 'category_id', 'product_id' );
    }


    public function getCategory($category_id)
    {
        $CategoryDescription =(new Category_description)->getTable() ;

        return $this->leftJoin($CategoryDescription,$CategoryDescription.'.category_id', $this->table  . '.category_id')
            ->where($CategoryDescription . '.language_id',session('language_id') )
            ->where( $this->table  . '.category_id',$category_id )
            ->where( $this->table  . '.status',1 );

     }

    public  function getAllCategories($data)
    {
         $category_descriptions =(new Category_description)->getTable() ;

        $categories  =  $this->leftJoin($category_descriptions,$category_descriptions.'.category_id', $this->table  . '.category_id')
            ->where($category_descriptions . '.language_id',session('language_id') );

       if(count($data['whereOpt'] ?? [])) {
            foreach ($data['whereOpt']  as $key => $value) {
                $categories = $categories->where($key, $value);
            }
        }

        if (!empty($data['keyword']))
        {
            $keyword=$data['keyword'];
            $categories = $categories->where(function ($sql) use($keyword){
                $sql->where($this->table .'.category_id',  $keyword )
                    ->orwhere('name', 'like', '%' . $keyword . '%');
            });
        }

        if (isset($data['sort_order'] )&& array_key_exists($data['sort_order'], $data['arrSort']))
        {
            $field = explode('__', $data['sort_order'])[0];
            $sort_field = explode('__', $data['sort_order'])[1];
            if ($field !='name') {
            $categories = $categories->orderBy($this->table .'.'.$field, $sort_field);
            }else{
                $categories = $categories->orderBy($category_descriptions .'.'.$field, $sort_field);

            }
        }else
        {
            $categories = $categories->orderBy($this->table .'.category_id', 'asc');
        }


        if (isset($data['paginate']) ) {
            $categories = $categories->paginate($data['paginate']);
        }
        else
        {
            if (isset($data['limit']) && $data['limit'] >0 )
                $categories=$categories->limit($data['limit'])->get() ;
            else
                $categories=$categories->get() ;
        }

        return  $categories ;
    }

 /*
    public function getTreeCategories($parent = 0, &$tree = [], $categories = null , &$tt='')
    {  dd( $this->getList()->toarray());
            $categories = $categories ?? $this->getList();
        $tree = $tree ?? [];

        $lisCategory = $categories[$parent] ?? [];
        if ($lisCategory) {
            foreach ($lisCategory as $key=> $category) {
            //    $tree[$category['category_id']] = $st . $category['name'];
                 $tt .= $key . $category['name'];  $tree[] = $tt;
                if (!empty($categories[$category['category_id']])) {
                   $tt .= ' > ' ;

                    $this->getTreeCategories($category['category_id'], $tree, $categories ,$tt);

                }  $tt='';

            }

        }
        return $tree;
    }

   public function getList($arrOpt = [], $arrSort = [], $arrLimit = [])
    {
        $tableDescription = (new Category_description)->getTable();


        $data = $this
            ->leftJoin($tableDescription, $tableDescription . '.category_id', $this->getTable() . '.category_id')
            ->where($tableDescription . '.language_id', 1);

        if(count($arrOpt = [])) {
            foreach ($arrOpt as $key => $value) {
                $data = $data->where($key, $value);
            }
        }

        $data = $data->get()->groupBy('parent_id');


        return $data;
    }

*/
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($category) {

            $category->Category_description()->delete();
            $category->Categorypath()->delete();
            $category->products()->detach();

        });
    }

}
