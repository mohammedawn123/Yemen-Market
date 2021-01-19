<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Admin;
use App\Attribute;
use App\Attribute_group;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\Language;
use App\Product;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class CustomersController extends Controller
{
    use AuthTrait ;
    public $languages, $countries;

    public function __construct()
    {
        $this->languages = Language::getList();
        $this->countries = Country::getList();

    }
    public function index()
    {
        $breadcrumb = [
            'buttons' => '   <a href="customers/create/new"   class="btn btn-primary"  data-toggle="tooltip" data-original-title="'.trans('customer.tooltip_add').'">
                                         <i class="fa fa-plus"></i> </a>
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('customer.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>
                          ',
            'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('customer.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        Session::flash('breadcrumbs' , $breadcrumb);


        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ?? 'id_desc';
        $show_rows = request('show_rows') ?? '10';
        $arrSort = [
            'customer_id__desc'   => 'id_desc',
            'customer_id__asc'    => 'id_asc',
            'first_name__desc' => 'name_desc',
            'first_name__asc'  => 'name_asc',
            'country__desc' => 'country_desc',
            'country__asc'  => 'country_asc',
        ];
        $arrRows =pagination_rows();
        $listTh = [
            'id' => trans('customer.id'),
            'name' => trans('customer.name'),
            'email' => trans('customer.email'),
            'phone' => trans('customer.phone'),
            'address1' => trans('customer.address1'),
            'address2' => trans('customer.address2'),
            'country' => trans('customer.country'),
            'status' => trans('customer.status'),
            'action' => trans('attribute.column_action'),
        ];

        $obj = new Customer;

        if ($keyword)
        {
            $obj = $obj->whereRaw('(customer_id = ' . (int) $keyword . ' OR email like "%' . $keyword . '%" OR first_name like "%' . $keyword . '%" OR last_name like "%' . $keyword . '%"  )');
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderby($field, $sort_field);
        }else
            {
              $obj = $obj->orderby('customer_id', 'desc');
            }

         $dataTmp = $obj->paginate($show_rows);
         $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id'      =>  (explode('__', $sort_order)[0])==='customer_id' ? '<h5  style="color: red;">'.$row['customer_id'].'</h5>': $row['customer_id'],
                'name'    => (explode('__', $sort_order)[0])==='first_name' ? '<h5 style="color: red;">'.$row['name'].'</h5>': $row['name'],
                'email'   => $row['email'],
                'phone'   => $row['phone'],
                'address1' => $row['address_1'],
                'address2' => $row['address_2'],
                'country' => (explode('__', $sort_order)[0])==='country' ? '<h5 style="color: red;">'.$this->countries[$row['country']]->name .'</h5>': $this->countries[$row['country']]->name ,
                'status' => ($row['status']) ? '
                                            <span style="font-weight: 700;font-size: 80%;" class="badge badge-info"> ON</span>' : '
                                               <span style="font-weight: 700;font-size: 80%;" class="badge badge-danger">OFF</span>',
                'action' => '
                    <a href="' . route('customers.edit', ['id' => $row['customer_id']]) . '">
                             <span data-toggle="tooltip"  data-original-title="' . trans('customer.tooltip_edit') . '" type="button" class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                    </a>&nbsp;
                    <span onclick="deleteItem(' . $row['customer_id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('customer.tooltip_delete') . '" class="btn btn-flat btn-danger">
                      <i class="fa fa-trash"></i>
                    </span>',
            ];
        }

        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $optionRows = '';
        foreach ($arrRows as $key => $status) {
            $optionRows .= '<option  ' . (($show_rows == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['title'] = 'YemenMarket | Customers';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.customers.list');
        $data['buttonSort'] =  1; // 1 - Enable button sort;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('customers.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.customers.list') . '" id="button_search">
                   <div   onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="Refresh"><i class="fa  fa-search"></i></a></div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="Search" value="' . $keyword . '"> </div>
                   </div>
                </form>';


   return view('admin.list')->with($data);
    }

    public function create()
       {
           $breadcrumb = [
               'buttons' => '  <button type="submit" form="form-customer" data-toggle="tooltip"   class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../customers" data-toggle="tooltip"   class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
               'heading_title' => ' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('customer.heading_title_add'),
           ];
           $breadcrumb['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
               'href' => 'admin.home2'
           );
           $breadcrumb['breadcrumbs'][] = array(
               'text' => 'Customer list',
               'href' => 'admin.customers.list'
           );

           $data = [
               'title'     => 'YemenMarket | Customer Form',
               'action'    => url('admin/customers/store'),
               'countries' => $this->countries,
               'customer_groups' => (new CustomerGroup)->getList(),

           ];
           Session::flash('breadcrumbs' , $breadcrumb);
           return view('admin.customer_form')->with($data);

       }
    public function store(Request $request)
    {
        $data            = $request->all();
        $dataMapping = $this->mappingValidator($data);
        $validator =  Validator::make($data, $dataMapping['validate'], $dataMapping['messages']);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        Customer::createCustomer($dataMapping['dataInsert']);
        return redirect()->route('admin.customers.list');
    }
    public function edit($id)
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-customer" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../customers" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('customer.heading_title_edit'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'Customer list',
            'href' => 'admin.customers.list'
        );

        $customer = Customer::find($id);
        if ($customer === null) {
            return 'no data';
        }

        $data = [
            'title'     => 'YemenMarket | Customer Form',
            'action'    => url('admin/customers/update'),
            'countries' => $this->countries,
            'customer'  => $customer,
            'customer_groups' => (new CustomerGroup)->getList(),

              ];

        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.customer_form')->with($data);
    }
    public function  update(Request $request)
    {

        $data= $request->all();
        $dataMapping = $this->mappingValidatorEdit($data);
        $validator =  Validator::make($data, $dataMapping['validate'], $dataMapping['messages']);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        Customer::updateInfo($dataMapping['dataUpdate'], $data['customer_id']);
        return redirect()->route('admin.customers.list');
    }

    public function delete(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            Customer::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }


}
