<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShopOrderStatus;
use App\tax_rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTaxController extends Controller
{

   public function index()
    {
        $breadcrumb = [
            'buttons' => '     <span onclick="showPopup(null);" data-toggle="tooltip"  data-original-title="Edit" type="button"    class="btn btn-flat btn-primary">
                                  <i class="fa fa-plus"></i>
                             </span> &nbsp;
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('attribute.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>
                                           ',
            'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('taxes.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ?? 'id_desc';
        $show_rows = request('show_rows') ?? '10';
        $arrSort = [
            'tax_rate_id__desc'   => 'tax_rate_id_desc',
            'tax_rate_id__asc'    => 'tax_rate_id_asc',
            'name__desc' => 'name_desc',
            'name__asc'  => 'name_asc',
            'type__desc' => 'type_desc',
            'type__asc'  => 'type_asc',

        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'              => trans('taxes.id'),
            'name'            => trans('taxes.name'),
            'rate'            => trans('taxes.rate'),
            'type'            => trans('taxes.type'),
            'created_at'      => trans('taxes.created_at'),
            'updated_at'      => trans('taxes.updated_at'),
            'action'          => trans('taxes.action'),
        ];

        $obj = (new tax_rate());

        if ($keyword)
        {
            $obj = $obj->where(function ($sql) use($keyword){
                $sql->where('tax_rate_id',  $keyword )
                    ->orwhere('name', 'like', '%' . $keyword . '%')
                    ->orwhere('type', 'like', '%' . $keyword . '%');
            });
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderBy($field, $sort_field);
        }else
        {
            $obj = $obj->orderBy('tax_rate_id', 'desc');
        }
        $dataTmp = $obj->paginate($show_rows);
        $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id'       =>$row['tax_rate_id'],
                'name'     => $row['name'] ,
                'rate'     => $row['rate'] ,
                'type'     => $row['type'] ,
                'created_at'=> $row['created_at'] ,
                'updated_at'=> $row['updated_at'] ,
                'action'   => '
                             <span onclick="showPopup(' . $row['tax_rate_id'] . ');" data-toggle="tooltip"  data-original-title="Edit" type="button"    class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span> &nbsp;
                    <span onclick="deleteItem(' . $row['tax_rate_id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_delete') . '" class="btn btn-flat btn-danger">
                      <i class="fa fa-trash"></i>
                    </span>',
            ];
        }

        $optionSort = '';
        foreach ($arrSort as $key => $value) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $value . '</option>';
        }
        $optionRows =  '';
        foreach ($arrRows as $key => $value) {
            $optionRows .= '<option  ' . (($show_rows == $key) ? "selected" : "") . ' value="' . $key . '">' . $value . '</option>';
        }

        $data['title'] = 'YemenMarket | Taxes';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.taxes.list');
        $data['buttonSort'] =  1;
        $data['optionRows'] = $optionRows;
        $data['urlEdit'] = route('admin.taxes.edit');
        $data['urlSave'] = route('admin.taxes.save');
        $data['urlDeleteItem'] = route('admin.taxes.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['page'] = "tax_popup";
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.taxes.list') . '" class="button_search">
                   <div   onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="Refresh"><i class="fa  fa-search"></i></a></div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="Search" value="' . $keyword . '">
                            </div>
                   </div>

                </form>';


        Session::flash('breadcrumbs' , $breadcrumb);

        return view('admin.list')->with($data);
    }

    public function edit()
    {
        $id = request('id');
        $data=tax_rate::find($id);
        $data['title']  ='Edit a Tax #'. $id;
        return response()->json($data);
    }


    public function save()
    {
        if (!request()->ajax())
        {
            return response()->json(['title' => 'Warning', 'msg' => 'Method not allow!' ,'type' => 'error']);
        } else {
            tax_rate::updateOrCreate(
                [
                    'tax_rate_id' => request('id')
                ], request('tax'));

            $title = request('id') == null ? 'created' : 'updated';
            $msg = 'Item has been ' . $title . ' successfully.';
            return response()->json(['title' => $title, 'msg' => $msg, 'type' => 'success']);
        }
    }

    public function delete(Request $request)
    {
        if (!request()->ajax())
        {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        }
        else
            {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            tax_rate::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }

}

