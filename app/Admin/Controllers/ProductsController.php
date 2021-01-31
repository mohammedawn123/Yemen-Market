<?php

namespace App\Admin\Controllers;

use App\Attribute;
use App\Attribute_group;
use App\Attribute_group_description;
use App\Http\Controllers\Controller;

use App\Length_class;
use App\Manufacturer;
use App\Mcategory;
use App\Models\CustomerGroup;
use App\Product;
use App\Product_description;
use App\product_special;
use App\product_to_category;
use App\Stock_status;
use App\tax_class;
use App\tax_rate;
use App\tax_rule;
use App\Weight_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

  public function index()
    {

        $breadcrumb = [
            'buttons'       => getTopButtons('products/create/new'),
            'heading_title' =>'<i class="fa fa-bar-chart"></i> '. trans('product.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> '.trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => trans('product.heading_title'),
            'href' => 'admin.products.list'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ;
        $show_rows = request('show_rows') ?? '10';
        $status = request('status')   ;
        $arrSort = [
            'products.product_id__desc'   => trans('category.id_desc'),
            'products.product_id__asc'    => trans('category.id_asc'),
            'name__desc'          => trans('category.name_desc'),
            'name__asc'           => trans('category.name_asc'),
            'status__desc'        => trans('category.status_desc'),
            'status__asc'         => trans('category.status_asc'),
            'quantity__desc'    => trans('category.quantity_desc'),
            'quantity__asc'     => trans('category.quantity_asc'),


        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'                 => trans('category.column_id'),
            'image'              => trans('category.column_image'),
            'name'               => trans('category.column_name'),
            'category'           => 'Category',
            'price'              => 'Price',
            'quantity'              => 'Quantity',
            'status'             => trans('category.column_status'),
            'created_at'         => 'Created_at',
            'updated_at'         => 'Updated_at',
            'action'             => trans('category.column_action'),
        ];
        $product_filter = array(
            'keyword'     => $keyword,
            'sort_order'  => $sort_order,
            'arrSort'     => $arrSort,
            'paginate'    => $show_rows,
            'status'      => $status,
        );





        $tableDescription = (new Product_description)->getTable();
        $tableProduct = (new Product)->getTable();
        $obj = (new Product)
            ->leftJoin($tableDescription, $tableDescription . '.product_id', $tableProduct . '.product_id')
            ->where($tableDescription . '.language_id',session('language_id') );

        if ($keyword)
        {

            $obj = $obj->where(function ($sql) use($keyword , $tableProduct,$tableDescription ){
                $sql->where($tableProduct .'.product_id',  $keyword )
                    ->orwhere($tableDescription .'.name', 'like', '%' . $keyword . '%')
                    ->orwhere($tableProduct.'.created_at',  'like', '%' . $keyword . '%');

            });

        }

        if (isset($status)) {        // $status != null
            $obj = $obj->where('status', (int) $status);
        }
        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];

            $obj = $obj->orderby($field, $sort_field);
        }else
        {
            $obj = $obj->orderby('products.product_id', 'desc');
        }

      $dataTmp = $obj->paginate($show_rows);
        $dataTr = [];

foreach ($dataTmp as $row)
{

    $ProductCategory='';
    $whereOpt= array('status' => 1) ;
     $categories=(new Mcategory)->getAllCategories( array('whereOpt'=> $whereOpt) )->keyby('category_id')->toarray();

    $price= '';

///////////////// get categories of product //////////////////////
    foreach ($row->categories as $category)
    {
        $ProductCategory.='&nbsp;  <span style="font-weight: 700;font-size: 75%;" class="badge badge-info">'.$categories[$category->category_id]['name'].'  </span>';
    }
///////////////// get special of product //////////////////////
     if($row->productSpecial() != -1)
         {
            $price=' <span style="text-decoration: line-through;">'. currency_symbol($row['price'] , null).'</span><br/>
                      <div class="text-danger">'.  currency_symbol($row->productSpecial() , null) .'</div>';
          } else
              {
                  $price = currency_symbol($row['price'] , null);
              }

        if($row['quantity']> $row['minimum'])
               $quantity='<span class="label label-success">'.$row['quantity'] .'</span>';
        else
               $quantity='<span data-toggle="tooltip" data-original-title="the minimum quantity is '.$row['minimum'].'" class="label label-warning">'.$row['quantity'] .'</span>';

///////////////// data table row array /////////////
    $dataTr[] = [
        'id'         =>$row['product_id'],
        'image'      =>image_thumbnail($row['image']),
        'name'       => $row['name'],
        'category'   => $ProductCategory,
        'price'      => $price ,
        'quantity'   => $quantity,
        'status'     => getStatusColumn($row['status'])  ,
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'] ,
        'action'     => getActionColumn('admin.product.edit'  ,  $row['product_id'] ),
    ];

}
        $optionSort =  selectOptions($arrSort , $sort_order);
        $optionRows =  selectOptions($arrRows , $show_rows);


 //////////////////// the return data array    /////////////////

        $data['title'] = 'YemenMarket | Products';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.products.list');
        $data['buttonSort'] =  1;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('admin.products.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']  = pagination($dataTmp)['pagination'];
        $data['resultItems'] = pagination($dataTmp)['resultItems'];
        $data['topMenuRight'][] ='
                <form action="' . route('admin.products.list') . '" class="button_search">
                    <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="Refresh"><i class="fa  fa-search"></i></a>
                    </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control search" placeholder="Search" value="' . $keyword . '">
                            </div>
                   </div>

                  <div class="btn-group pull-left">
                         <div class="form-group">

                           <select class="form-control" name="status" id="status">
                           <option value=""  >' .trans('category.text_all').'</option>
                          <option value="1" ' . (($status === 1) ? "selected" : "").'>  ' .trans('category.text_enabled').' </option>
                          <option value="0"  ' . (($status === 0) ? "selected" : "").'>'.trans('category.text_disabled').'</option>
                        </select> </div>
                   </div>

                </form> ';

 return view('admin.list' )->with($data);
    }


    public function create()
    {


        $breadcrumbs['buttons']='  <button type="submit" form="form-product" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
        <a href="'.route('admin.products.list').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
       ';

        $breadcrumbs['heading_title']=' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('product.heading_title_add');
        $breadcrumbs['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> '.trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $breadcrumbs['breadcrumbs'][] = array(
            'text' => trans('product.heading_title'),
            'href' => 'admin.products.list'
        );
        Session::flash('breadcrumbs' , $breadcrumbs);

        $data['action']=url('admin/products/store') ;
        $data['stock_statuses']=Stock_status::where('language_id'  ,session('language_id') )->get()->toArray();
        $data['length_classes']=Length_class::with(['Length_class_descriptions'=> function($query)
                  {  $query->where('language_id' , session('language_id') );  }])->get()->toArray();
        $data['weight_classes']=Weight_class::with(['Weight_class_descriptions'=> function($query)
                   {  $query->where('language_id' , session('language_id') );  }])->get()->toArray();
        $data['tax_rates']=  tax_rate::get()->toArray();
        $data['customer_groups']= (new CustomerGroup)->getList();


    return view('admin.product_form' ,$data);
    }


    public function store(Request $request)
    {
      $product_categories  = $request->get('product_category');
      $product_details     = $request->get('product');
      $product_description = $request->get('product_description');

      $validator=$this->product_validation( $request->all());
     // $validator=$this->product_validation($product_details);

        if($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $product_details['stock_status_id']=0;
       $product= Product::create($product_details);
        $product->Product_description()->createMany($product_description);


//////////////////////////// product categories /////////////////////////
        $categories=Mcategory::find($product_categories);
        $product->categories()->attach($categories);

//////////////////////////// product attributes /////////////////////////
        $ProductAttributes=$request->get('product_attribute');
        if(isset($ProductAttributes))
        {
            $product_attributes=$this->formatProductAttributes($ProductAttributes);
            $product->attributes()->attach( $product_attributes[0]);
        }

//////////////////////////// product discounts /////////////////////////
        $ProductDiscounts=$request->get('product_discount');
        if(isset($ProductDiscounts)) {
            $product->product_discounts()->createMany($ProductDiscounts);
        }

//////////////////////////// product specials /////////////////////////
        $ProductSpecials=$request->get('product_special');
        if(isset($ProductSpecials)) {
            $product->product_specials()->createMany($ProductSpecials);
        }

        $success= 'the Product created successfully' ;
        Session::flash('success' , $success);

        return redirect()->route('admin.products.list');
    }


    public function edit($id)
    {


        $breadcrumbs['buttons']='  <button type="submit" form="form-product" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
        <a href="'.route('admin.products.list').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
       ';

        $breadcrumbs['heading_title']=' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('product.heading_title_edit');
        $breadcrumbs['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> '.trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $breadcrumbs['breadcrumbs'][] = array(
            'text' => trans('product.heading_title'),
            'href' => 'admin.products.list'
        );
        Session::flash('breadcrumbs' , $breadcrumbs);
//////////////////////////// product attributes /////////////////////////


        $product=  Product::find( $id);
      $Product_description=$product->Product_description()->get()->keyby('language_id')->toArray();

        $data=$product->toarray();
        $data['product_description']=$Product_description;

        // get categories of product
        $ids=$product->categories->keyby('category_id')->toarray();
        $whereinOpt=array('mcategories.category_id' =>   array_keys( $ids));
        $categories=(new Mcategory)->getAllCategories( array('whereinOpt'=>$whereinOpt) );
        $data['categories']=$categories->toarray();

        // get attributes of product
        $product_attributes =$product->getProductAttributes($id);
        $data['product_attributes'] = array();

        foreach ($product_attributes as $product_attribute) {

            $attribute=Attribute::find($product_attribute['attribute_id']);
            $attributeDescription=$attribute->Attribute_description()->where('language_id' , session('language_id') )->get()->keyby('language_id')->toarray();
        if($attributeDescription === [])
            $attributeDescription=$attribute->Attribute_description()->where('language_id' ,1 )->get()->keyby('language_id')->toarray();

                $data['product_attributes'][] = array(
                    'attribute_id'                  => $attribute['attribute_id'],
                    'name'                          => $attributeDescription[ session('language_id')]['name'] ?? $attributeDescription[1]['name'],
                    'product_attribute_description' => $product_attribute['product_attribute_description']
                );

        }

//////////////////////////// product discounts /////////////////////////
         $product_discounts=$product->product_discounts->toArray();
        $data['product_discounts']= $product_discounts;

//////////////////////////// product specials /////////////////////////

        $product_specials=$product->product_specials->toArray();
        $data['product_specials']= $product_specials;
        $data['customer_groups']= (new CustomerGroup)->getList();
        $data['manufacturer']=$product->Manufacturer;
        $data['tax_rates']=  tax_rate::get()->toArray();
        $data['action']=url('admin/products/update') ;

   return view('admin.product_form' , $data);

    }

    public function update(Request $request)
    {
        $product_description=$request->get('product_description');
        $product= Product::find($request->get('product_id'));
        $product->update($request->get('product'));

        $product->Product_description()->delete();
        $product->Product_description()->createMany($product_description);

     //////////////////////////// product categories /////////////////////////
        $categories=Mcategory::find($request->get('product_category'));
        $product->categories()->sync($categories);


     //////////////////////////// product attributes /////////////////////////
        $ProductAttributes=$request->get('product_attribute');
        if(isset($ProductAttributes)) {
            $product_attributes = $this->formatProductAttributes($ProductAttributes);
            $product->attributes()->sync($product_attributes[0]);
        }


     //////////////////////////// product discounts /////////////////////////
        $product_discounts=$request->get('product_discount');
        $this->UpdateDiscounts($product_discounts ,$request->get('product_id'));


      //////////////////////////// product specials /////////////////////////
        $product_specials=$request->get('product_special');
        $this->UpdateSpecials($product_specials ,$request->get('product_id'));



        $success= 'the Product updated successfully' ;
        Session::flash('success' , $success);

        return redirect()->route('admin.products.list');

    }


   public function UpdateDiscounts($product_discounts, $product_id)
     {
         $product= Product::find($product_id);
         $product_discount_ids=[];
         if($product_discounts !== null)
         {
             foreach ($product_discounts as $discount) {
                 $product_discount_ids[] = $product->product_discounts()->updateOrCreate(
                     [
                         'product_discount_id' => $discount['product_discount_id']
                     ], [
                     'customer_group_id' => $discount['customer_group_id'],
                     'quantity'   => $discount['quantity'],
                     'priority'   => $discount['priority'],
                     'price'      => $discount['price'],
                     'date_start' => $discount['date_start'],
                     'date_end'   => $discount['date_end'],
                 ])->toarray()['product_discount_id'];

             }
             ////////// deleted discounts //////
             $product->product_discounts()
                 ->where('product_id', $product_id)
                 ->wherenotin('product_discount_id', $product_discount_ids)
                 ->delete();
         }
         else{
             ////////// when delete all discounts ///////////
             $product->product_discounts()
                 ->where('product_id', $product_id)
                 ->delete();
         }

     }

    public function UpdateSpecials($product_specials, $product_id)
    {
        $product= Product::find($product_id);
        $product_special_ids=[];
        if($product_specials !== null)
        {
            foreach ($product_specials as $special) {
                $product_special_ids[] = $product->product_specials()->updateOrCreate(
                    [
                        'product_special_id' => $special['product_special_id']
                    ], [
                    'customer_group_id' => $special['customer_group_id'],
                    'priority'   => $special['priority'],
                    'price'      => $special['price'],
                    'date_start' => $special['date_start'],
                    'date_end'   => $special['date_end'],
                ])->toarray()['product_special_id'];

            }
            ////////// deleted specials //////
            $product->product_specials()
                ->where('product_id', $product_id)
                ->wherenotin('product_special_id', $product_special_ids)
                ->delete();
        }
        else{
            ////////// when delete all specials ///////////
            $product->product_specials()
                ->where('product_id', $product_id)
                ->delete();
        }

    }
    public function DeleteProduct(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            //$arrID = array_diff(["21" , "22"], ["25" ,"24" , "23"]); // return ["21" , "22"]
            Product::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }
       }
    public function manufacturer_autocomplete(Request $request)
    {
        $filter_data = array(
            'filter_name' =>  $request->get('filter_name'),
            'sort'        => 'name',
            'order'       => 'ASC',
            'start'       => 0,
            'limit'       => 5
        );
         $Manufacturers=DB::table('manufacturers');
        if (!empty($filter_data['filter_name']))
        {
            $Manufacturers=$Manufacturers->where('name' , 'like' ,'%' .$filter_data['filter_name'] .'%' ) ;
        }
        if ($filter_data['limit']>0 )
            $Manufacturers=$Manufacturers->where('status' , 1)->limit($filter_data['limit']) ;

        return  Response()->json($Manufacturers->get());

    }

    public function CategoriesAutocomplete()
    {

        $filter = array(
            'keyword'     => request()->get('filter_name'),
            'limit'       =>5,
            'whereOpt'    => array(
                                     'status'    => 1
                                  )
        );

        $Categories = (new Mcategory)->getAllCategories($filter) ;

         return  Response()->json($Categories);

    }

    public function AttributeAutocomplete()
    {
        $AttributeGroupDescription=(new Attribute_group_description)->getTable();
        $Attribute_group=(new Attribute_group)->leftJoin($AttributeGroupDescription ,$AttributeGroupDescription.'.a_g_id' ,(new Attribute_group)->getTable() . '.attribute_group_id' );
        $Attribute_group1=$Attribute_group->where($AttributeGroupDescription.'.language_id' , 1)->get();


        $json = [];
      foreach ($Attribute_group1 as $key => $row)
        {
            foreach ($row->Attributes as $Attribute)
             {
                  $attribute_name1 = $Attribute->Attribute_description()
                    ->where('language_id' ,  session('language_id') )->first();

                 if($attribute_name1 === null)
                  $attribute_name1 = $Attribute->Attribute_description()->where('language_id' , 1 )->first();

                  $json[] = array(
                             'attribute_id'    => $Attribute['attribute_id'],
                              'name'            => $attribute_name1->name ?? '',
                              'attribute_group' => $row['name']
                              );
                }
         }


        return  Response()->json($json);

    }

    public function formatProductAttributes($product_attribute=array())
    {
        $attributes=array();
        if($product_attribute !== null) {
            foreach ($product_attribute as $key1 => $productAttribute) {
                $attribute = Attribute::find($productAttribute['attribute_id']);

                foreach ($productAttribute['product_attribute_description'] as $key2 => $description) {
                    $attributes[0][$key2 . $key1] = array(
                        'attribute_id' => $productAttribute['attribute_id'],
                        'language_id' => $key2,
                        'text' => $description['text']
                    );
                }
            }
        }
        return $attributes ;
    }

    protected function product_validation($data)
    {
        $rules= [
            'product_description.*.name'=> 'required' ,
            'product_description.*.description'=> 'required' ,
            'product_description.*.meta_title'=> 'required' ,
            'product_description.*.meta_description'=> 'required' ,
            'product_description.*.meta_keyword'=> 'required' ,
            'product_description.*.tag'=> 'required' ,
            'product.model'=> 'required|unique:products,model' ,
            'product.sku'=> 'required|max:64' ,
            'product.upc'=> 'required|max:12' ,
            'keyword'=> 'required'
        ];
        $messages= [
            'required'=> 'هذا الحقل مطلوب' ,
            'product.model.unique'=> 'هذا الحقل موجود' ,
            'product.sku.max'=> 'يجب ان يكون عدد احرف هذا الحقل اقل من 64 حرف' ,
            'product.upc.max'=> 'يجب ان يكون عدد احرف هذا الحقل اقل من 12 حرف' ,


        ];
        return Validator::make($data , $rules , $messages);
        // return Validator::make($data , $rules , $messages)->validate();// if validation fails will automatically redirected

    }
}
