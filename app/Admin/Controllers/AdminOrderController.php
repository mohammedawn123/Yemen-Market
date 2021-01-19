<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\ShopCurrency;
use App\Models\ShopOrder;
use App\Models\ShopOrderDetail;
use App\Models\ShopOrderStatus;
use App\Models\ShopOrderTotal;
use App\Product;
use App\Product_description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminOrderController extends Controller
{
    public $statusOrder;
    public function __construct()
    {
        $this->statusOrder = ShopOrderStatus::getAll();
    }



   public function index()
    {
        $breadcrumb = [
            'buttons' => '   <a href="orders/create/new"   class="btn btn-primary"  data-toggle="tooltip" data-original-title="'.trans('attribute.tooltip_add').'">
                                         <i class="fa fa-plus"></i> </a>
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('attribute.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>


                                           ',
            'heading_title' =>'<i class="fa fa-bar-chart"></i> '. trans('order.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ?? 'id_desc';
        $show_rows = request('show_rows') ?? '10';
        $order_status = request('order_status') ?? '';
        $arrSort = [
            'id__desc'   => 'id_desc',
            'id__asc'    => 'id_asc',
            'email__desc' => 'email_desc',
            'email__asc'  => 'email_asc',
            'created_at__desc' => 'created_at_desc',
            'created_at__asc'  => 'created_at_asc',
        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'             => trans('order.id'),
            'customer_name'  => trans('order.customer_name'),
            'subtotal'       => trans('order.subtotal'),
            'shipping'       => trans('order.shipping'),
            'discount'       => trans('order.discount'),
            'tax'            => trans('order.tax'),
            'total'          => trans('order.total'),
         // 'received'       => trans('order.received'),
            'balance'        => trans('order.balance'),
            'payment_method' => trans('order.payment_method'),
            'currency'       => trans('order.currency'),
            'status'         => trans('order.status'),
            'created_at'     => trans('order.created_at'),
            'action'         => trans('order.action'),
        ];

        $obj = (new ShopOrder);

        if ($keyword)
        {
            $obj = $obj->where(function ($sql) use($keyword){
                $sql->where('id',  $keyword )
                    ->orwhere('email', 'like', '%' . $keyword . '%')
                    ->orwhere('created_at',  'like', '%' . $keyword . '%');
            });
        }
        if ((int) $order_status) {
            $obj = $obj->where('status', (int) $order_status);
        }
        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderby($field, $sort_field);
        }else
        {
            $obj = $obj->orderby('id', 'desc');
        }

        $dataTmp = $obj->paginate($show_rows);

        $styleStatus = $this->statusOrder;
        array_walk($styleStatus, function (&$v, $k) {
            $v = '<span  class="badge badge-' . (ShopOrder::$mapStyleStatus[$k] ?? 'light') . '">' . $v . '</span>';
        });
        $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id' => $row['id'],
                'customer_name'    => $row['first_name'] .' '. $row['last_name'],
                'subtotal' => currency_symbol($row['subtotal'] ?? 0, $row['currency']),
                'shipping' => currency_symbol($row['shipping'] ?? 0, $row['currency']),
                'discount' => currency_symbol($row['discount'] ?? 0, $row['currency']),
                'tax'      => currency_symbol($row['tax'] ?? 0, $row['currency']),
                'total'    => currency_symbol($row['total'] ?? 0, $row['currency']),
             //  'received'      => currency_symbol($row['received'] ?? 0, $row['currency']),
                'balance'        => currency_symbol($row['balance'] ?? 0, $row['currency']),
                'payment_method' => $row['payment_method'],
                'currency'       => $row['currency'] . '/' . $row['exchange_rate'],
                'status'         => $styleStatus[$row['status']],
                'created_at'     => $row['created_at'],
                'action'         => '
                          <a href="' . route('admin.order.print', ['id' => $row['id']]) . '">
                             <span   data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_edit') . '" type="button" class="btn btn-flat btn-success">
                                  <i class="fa fa-print"></i>
                             </span>
                          </a>&nbsp;
                    <a href="' . route('admin.orders.edit', ['id' => $row['id']]) . '">
                             <span data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_edit') . '" type="button" class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                    </a>&nbsp;
                    <span onclick="deleteItem(' . $row['id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_delete') . '" class="btn btn-flat btn-danger">
                      <i class="fa fa-trash"></i>
                    </span>',
            ];
        }

        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $optionRows =  '';
        foreach ($arrRows as $key => $status) {
            $optionRows .= '<option  ' . (($show_rows == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }
        $optionStatus = '';
        foreach ($this->statusOrder as $key => $status) {
            $optionStatus .= '<option  ' . (($order_status == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }
        $data['title'] = 'YemenMarket | Orders';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.orders.list');
        $data['buttonSort'] =  1;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('admin.orders.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.orders.list') . '" class="button_search">
                   <div   onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="Refresh"><i class="fa  fa-search"></i></a></div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="Search" value="' . $keyword . '">
                            </div>
                   </div>

                    <div class="btn-group pull-left">
                         <div class="form-group">
                           <select class="form-control" name="order_status" id="order_sort">
                           <option value="">All</option>
                        ' . $optionStatus . '
                        </select> </div>
                   </div>
                </form>';


        Session::flash('breadcrumbs' , $breadcrumb);

        return view('admin.list')->with($data);
    }

    public function create()
    {

        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-order" data-toggle="tooltip" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../orders" data-toggle="tooltip"   class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('attribute.heading_title_add'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $data = [
            'title'          => 'YemenMarket | Order Form',
            'action'         => url('admin/orders/store'),
            'customers'      => (new Customer)->getListAll(),
            'countries'      => (new Country)->getList(),
            'currencies'     => (new ShopCurrency)->getListActive(),
            'orderStatus'    => $this->statusOrder ,
            'currenciesRate' => json_encode(ShopCurrency::getListRate()) ,
            'paymentMethod'  => [] ,
            'shippingMethod' => [],
        ];

        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.order_form')->with($data);

    }


    public function store(Request $request)
    {
        $data = $request->all();
        $dataInsert = [
            'customer_id'         => $data['customerId'],
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'] ?? '',
            'status'          => $data['status'],
            'currency'        => $data['currency'],
            'address1'        => $data['address1'],
            'address2'        => $data['address2'] ?? '',
            'country'         => $data['country'] ?? '',
            'phone'           => $data['phone'] ?? '',
            'payment_method'  => $data['payment_method'] ?? null,
            'shipping_method' => $data['shipping_method'] ?? null,
            'exchange_rate'   => $data['exchange_rate'],
            'email'           => $data['email'],
            'comment'         => $data['comment'],
        ];
        $order = ShopOrder::create($dataInsert);
       ShopOrderTotal::insert([
            ['code' => 'subtotal', 'value' => 0, 'title' => 'Subtotal', 'sort' => 1, 'order_id' => $order->id],
            ['code' => 'tax', 'value' => 0, 'title' => 'Tax', 'sort' => 2, 'order_id' => $order->id],
            ['code' => 'shipping', 'value' => 0, 'title' => 'Shipping', 'sort' => 10, 'order_id' => $order->id],
            ['code' => 'discount', 'value' => 0, 'title' => 'Discount', 'sort' => 20, 'order_id' => $order->id],
            ['code' => 'total', 'value' => 0, 'title' => 'Total', 'sort' => 100, 'order_id' => $order->id],
            ['code' => 'received', 'value' => 0, 'title' => 'Received', 'sort' => 200, 'order_id' => $order->id],
        ]);
        return redirect()->route('admin.orders.list');
    }
    public function edit($id)
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-order" data-toggle="tooltip" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                             <a href="../../orders" data-toggle="tooltip"   class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-pencil" aria-hidden="true"></i> Edit Order',
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        Session::flash('breadcrumbs' , $breadcrumb);
        $data=$this->orderDetail($id);
        $data['title']  ='YemenMarket | Order Form';
        $data['action'] =url('admin/orders/update');

        return view('admin.order_detail_form')->with($data);

    }


    public function update(Request $request)
    {
        $order_id=$request->get('id');
        $order=ShopOrder::find($order_id);
        $products=$request->get('products');
        $currency=$request->get('currency');
        $exchange_rate=$request->get('exchange_rate');


        $items = [];
        if($products)
        {
            foreach ($products as $product)
            {
                if ($product['quantity']) {

                    $items[] = array(
                        'product_id'    => $product['product_id'],
                        'name'          => $product['name'],
                        'quantity'      => $product['quantity'],
                        'price'         => $product['price'],
                        'total_price'   => $product['price'] * $product['quantity'],
                        'sku'           => $product['model'],
                        'tax'           => $product['tax'],
                        'attribute'     => '[]',
                        'currency'      => $currency,
                        'exchange_rate' => $exchange_rate,
                    );
                }

            }
        }
        if ($items)
        {
            try {

                  $ids2=[];

                foreach ($items as $item)
                {
                   $p=Product::find($item['product_id']);
                   if($item['quantity'] < $p->quantity && $item['quantity']  >= $p->minimum )
                   {
                       $ids2[]=$item['product_id'] ;
                       $ids= ShopOrderDetail::where('order_id',$order_id)
                           ->where('product_id' , $item['product_id'])
                           ->pluck('id')->toArray();
                           ShopOrderDetail::destroy($ids);

                         $order->details()->updateOrCreate(
                             [
                                 'order_id' => $order_id,
                                 'product_id' => $item['product_id']
                               ], $item);
                         Product::updateQuantity($item['product_id'], $item['quantity']);
                     }else
                         {
                             $warning= 'the minimum quantity of product <label>'.$item['name'] .'</label> is <label>'. $p->minimum .'</label>';
                             Session::flash('warning' , $warning);
                             return redirect()->back()->withInput($request->all());
                         }
                }
                $ids= ShopOrderDetail::where('order_id',$order_id)
                    ->wherenotin('product_id' , $ids2)
                    ->pluck('id')->toArray();
                     ShopOrderDetail::destroy($ids);

                $orderDetail = array(
                    'exchange_rate' => $request->get('exchange_rate'),
                    'first_name'    => $request->get('first_name'),
                    'last_name'     => $request->get('last_name'),
                    'address1'      => $request->get('address1'),
                    'address2'      => $request->get('address2'),
                    'currency'      => $request->get('currency'),
                    'country'       => $request->get('country'),
                    'comment'       => $request->get('comment'),
                    'status'        => $request->get('status'),
                    'email'         => $request->get('email'),
                    'phone'         => $request->get('phone'),
                );
                $order->update($orderDetail);

                $orderTotalDetails = array(
                    'subTotal'    => $request->get('subtotal') ,
                    'tax'         => $request->get('tax_subtotal') ,
                    'shipping'    => $request->get('shipping') ,
                    'discount'    => $request->get('discount') ,
                    'total'       => $request->get('total')  ,
                    'received'    => $request->get('received') ,
                    'tax2'        => $request->get('tax2') ,
                    'balance'     => $request->get('balance') ,
                );
                (new ShopOrderTotal)->updateSubtotal($order_id , $orderTotalDetails);


           return redirect()->route('admin.orders.list');


            } catch (\Exception $e) {
                return response()->json(['error' => 1, 'msg' => 'Error: ' . $e->getMessage()]);
            }
        }

    return redirect()->route('admin.orders.list');

    }
    public function delete(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            //$arrID = array_diff(["21" , "22"], ["25" ,"24" , "23"]); // return ["21" , "22"]
            ShopOrder::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }
    public function orderDetail($id)
    {
        $order=ShopOrder::find($id);
        return [
            'customers'      => (new Customer)->getListAll(),
            'countries'      => (new Country)->getList(),
            'currencies'     => (new ShopCurrency)->getListActive(),
            'products'       => (new Product)->getAllProducts()->get(),
            'order'          => $order ,
            'order_details'  => $order->details ,
            'orderStatus'    => $this->statusOrder ,
            'currenciesRate' => json_encode(ShopCurrency::getListRate()) ,
            'paymentMethod'  => [] ,
            'shippingMethod' => [],
            'customer_groups' => [],
        ];

    }

    public function getInfoCustomer()
    {
        $id = request('id');
        return Customer::find($id)->toJson();
    }

    public function getProductInfo()
    {
        $id = request('id');
        $order_id = request('order_id');
        $oder = ShopOrder::find($order_id);

        $product = (new Product)->getDetail($id);

        $arrayReturn = $product->toArray();
       // $arrayReturn['renderAttDetails'] = $product->renderAttributeDetailsAdmin($oder->currency, $oder->exchange_rate);
        $arrayReturn['price_final'] = $product->getPriceAfterDiscount();
       $arrayReturn['tax'] =$product->getTaxRate();

        return response()->json($arrayReturn);
    }

    public function orderPrint($id)
    {
        $breadcrumb = [
            'buttons' => '
                             <span onclick="order_print();"  data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_edit') . '" type="button" class="btn btn-flat btn-success">
                                  <i class="fa fa-print"></i>
                             </span>
                             <a href="../../orders" data-toggle="tooltip"   class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                          ',
            'heading_title' => 'Print Order Details ',
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => ' ',
            'href' => 'admin.home2'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $order=ShopOrder::find($id);
        $arrDetails=$order->details;

        $products=(new Product)->getAllProducts()->get()->keyby('product_id')->toArray();
        $orderDetails=$order->details->keyby('product_id')->toArray() ;
        $orderProducts=[];

       foreach ($orderDetails as $key=>$value)
       {
            $orderProducts[$key] = $value;
            $orderProducts[$key]['image'] = $products[$key]['image'];
           }

        $order['country']=Country::getByCode($order['country']);
        $order['status']=$order->orderStatus->name ;
        $data= [
            'order'          => $order ,
            'order_details'  => $orderProducts,
            'paymentMethod'  => [] ,
            'shippingMethod' => [],
            'customer_groups' => [],
        ];

        return view('admin.order_print')->with($data);
    }

}

