<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopOrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminOrderStatusController extends Controller
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
            'heading_title' =>'<i class="fa fa-bar-chart"></i> '.  trans('orderstatus.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ?? 'id_desc';
        $show_rows = request('show_rows') ?? '10';
        $arrSort = [
            'id__desc'   => 'id_desc',
            'id__asc'    => 'id_asc',
            'name__desc' => 'name_desc',
            'name__asc'  => 'name_asc',

        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'              => trans('orderstatus.id'),
            'name'            => trans('orderstatus.name'),
            'action'          => trans('orderstatus.action'),
        ];

        $obj = (new ShopOrderStatus);

        if ($keyword)
        {
            $obj = $obj->where(function ($sql) use($keyword){
                $sql->where('id',  $keyword )
                    ->orwhere('name', 'like', '%' . $keyword . '%');
            });
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderBy($field, $sort_field);
        }else
        {
            $obj = $obj->orderBy('id', 'desc');
        }
        $dataTmp = $obj->paginate($show_rows);
        $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id'       =>$row['id'],
                'name'     => $row['name'] .'<input  type="hidden" class="form-control orderstatus_id" value="'. $row['id'].'" />',
                'action'   => '
                             <span onclick="showPopup(' . $row['id'] . ');" data-toggle="tooltip"  data-original-title="Edit" type="button"    class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span> &nbsp;
                    <span onclick="deleteItem(' . $row['id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_delete') . '" class="btn btn-flat btn-danger">
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

        $data['title'] = 'YemenMarket | OrderStatuses';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.orderStatuses.list');
        $data['buttonSort'] =  1;
        $data['optionRows'] = $optionRows;
        $data['urlEdit'] = route('admin.orderStatuses.edit');
        $data['urlSave'] = route('admin.orderStatuses.save');
        $data['urlDeleteItem'] = route('admin.orderStatuses.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['page'] = "order_status_popup";
      //  $data['scripts'] = ' <script src="'.url('/').'/view/javascript/popup.js" type="text/javascript"></script>';
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.orderStatuses.list') . '" class="button_search">
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
        $data=ShopOrderStatus::find($id);
        $data['title']  ='Edit a Status #'. $id;
        return response()->json($data);
    }


    public function save()
    {
        if (!request()->ajax())
        {
            return response()->json(['title' => 'Warning', 'msg' => 'Method not allow!' ,'type' => 'error']);
        } else {
            ShopOrderStatus::updateOrCreate(
                [
                    'id' => request('id')
                ], request('statuses'));

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
        } else
            {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            ShopOrderStatus::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }

}

