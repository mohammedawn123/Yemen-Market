<?php

namespace App\Admin\Controllers;

use App\Attribute;
use App\Attribute_group;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\GroupDescription;
use App\Models\Language;
use App\Product;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class CustomerGroupController extends Controller
{
    public $languages, $countries;

    public function __construct()
    {
        $this->languages = Language::getList();
        $this->countries = Country::getList();

    }
    public function index()
    {
        $breadcrumb = [
            'buttons' => '   <a href="customer_group/create/new"   class="btn btn-primary"  data-toggle="tooltip" data-original-title="'.trans('customer_group.tooltip_add').'">
                                         <i class="fa fa-plus"></i> </a>
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('customer_group.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>
                    ',
            'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('customer_group.heading_title'),
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
            'id__desc'   => 'id_desc',
            'id__asc'    => 'id_asc',
            'name__desc' => 'name_desc',
            'name__asc'  => 'name_asc',
            'sort_order__desc' => 'sort_order_desc',
            'sort_order__asc' => 'sort_order_asc',
        ];
        $arrRows =pagination_rows();
        $listTh = [
            'id' => trans('customer_group.id'),
            'name' => trans('customer_group.name'),
            'description' => trans('customer_group.description'),
            'sort_order' => trans('customer_group.sort_order'),
            'status' => trans('customer_group.status'),
            'action' => trans('customer_group.action'),
        ];

        $GroupDescription = (new GroupDescription)->getTable();
        $CustomerGroup = (new CustomerGroup);
        $obj = $CustomerGroup->leftjoin($GroupDescription ,$GroupDescription.'.customer_group_id'  ,$CustomerGroup->getTable().'.customer_group_id')
        ->where($GroupDescription.'.language_id' , session('language_id'));


        if ($keyword)
        {
            $obj = $obj->where(function ($sql) use($GroupDescription, $keyword){
                $sql->where($GroupDescription . '.name', 'like', '%' . $keyword . '%')
                    ->orWhere($GroupDescription . '.description', 'like', '%' . $keyword . '%');
            });
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderby($field, $sort_field);
        }else
            {
              $obj = $obj->orderby($GroupDescription.'.customer_group_id', 'desc');
            }

         $dataTmp = $obj->paginate($show_rows);
         $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id'      => $row['customer_group_id'],
                'name'    => strtoupper($row['name']),
                'description'   => $row['description'],
                'sort_order'   => $row['sort_order'],
                'status'   => ($row['status'])===1 ? '
                                          <span style="font-weight: 700;font-size: 80%;" class="badge badge-info">Enabled</span>' : '
                                             <span style="font-weight: 700;font-size: 80%;" class="badge badge-danger">Disabled</span>',
                'action' => '
                    <a href="' . route('customer_group.edit', ['id' => $row['customer_group_id']]) . '">
                             <span data-toggle="tooltip"  data-original-title="' . trans('customer_group.tooltip_edit') . '" type="button" class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                    </a>&nbsp;
                    <span onclick="deleteItem(' . $row['customer_group_id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('customer_group.tooltip_delete') . '" class="btn btn-flat btn-danger">
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

        $data['title'] = 'YemenMarket | Customer Group';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.customer_group.list');
        $data['buttonSort'] =  1; // 1 - Enable button sort;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('customer_group.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.customer_group.list') . '" id="button_search">
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
               'buttons' => '  <button type="submit" form="form-customer_group" data-toggle="tooltip"   class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../customer_group" data-toggle="tooltip"   class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
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
               'title'     => 'YemenMarket | Customer Group Form',
               'action'    => url('admin/customer_group/store'),
               'languages' => $this->languages,
           ];
           Session::flash('breadcrumbs' , $breadcrumb);
           return view('admin.customer_group_form')->with($data);

       }

    public function store(Request $request)
    {
        $data            = $request->all();
      /*  $dataMapping = $this->mappingValidator($data);
        $validator =  Validator::make($data, $dataMapping['validate'], $dataMapping['messages']);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }*/
      $CustomerGroup=  CustomerGroup::create([
          'sort_order'=>$request->get('sort'),
          'status'=>$request->get('status'),
          ]);
        $CustomerGroup->descriptions()->createmany($request->get('customer_group'));
        return redirect()->route('admin.customer_group.list');
    }
    public function edit($id)
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-customer_group" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../customer_group" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('customer.heading_title_edit'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'Customer list',
            'href' => 'admin.customer_group.list'
        );

        $CustomerGroup = CustomerGroup::find($id);
        if ($CustomerGroup === null) {
            return 'no data';
        }

        $data = [
            'title'     => 'YemenMarket | Customer Group Form',
            'action'    => url('admin/customer_group/update'),
            'languages' => $this->languages,
            'customer_group' =>$CustomerGroup,

              ];

        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.customer_group_form')->with($data);
    }
    public function  update(Request $request)
    {
        $CustomerGroup=  CustomerGroup::find($request->get('id'));
        $CustomerGroup->update([
            'sort_order'=>$request->get('sort'),
            'status'=>$request->get('status'),
        ]);
        $CustomerGroup->descriptions()->delete();
        $CustomerGroup->descriptions()->createmany($request->get('customer_group'));
         return redirect()->route('admin.customer_group.list');
    }

    public function delete(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            CustomerGroup::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }


}
