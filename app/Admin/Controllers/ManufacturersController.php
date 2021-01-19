<?php

namespace App\Admin\Controllers;

use App\Attribute;
use App\Attribute_description;
use App\Attribute_group;
use App\Attribute_group_description;
use App\Http\Controllers\Controller;
use App\Manufacturer;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ManufacturersController extends Controller
{
    public function index()
    {

     //   return app()->abort(404, 'Page not found!');
        $breadcrumb = [
            'buttons' => '   <a href="manufacturers/create/new"   class="btn btn-primary"  data-toggle="tooltip" data-original-title="'.trans('manufacturer.tooltip_add').'">
                                         <i class="fa fa-plus"></i> </a>
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('manufacturer.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>
                          ',
            'heading_title' =>'<i class="fa fa-bar-chart"></i> '. trans('manufacturer.heading_title'),
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
            'sort__desc' => 'sort_desc',
            'sort__asc'  => 'sort_asc',
        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'             => trans('manufacturer.column_id'),
            'image' => trans('manufacturer.column_image'),
            'name' => trans('manufacturer.column_name'),
            'email' => trans('manufacturer.column_email'),
            'phone' => trans('manufacturer.column_phone'),
           // 'address' => trans('manufacturer.column_address'),
            'status' => trans('manufacturer.column_status'),
           // 'sort'           => trans('manufacturer.column_sort'),
            'action'         => trans('manufacturer.column_action'),
        ];

        $obj = new  Manufacturer;


        if ($keyword) {
            $obj = $obj->where(function ($sql) use($keyword){
                $sql->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
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
         $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id' => $row['id'],
                'image' => '<img class="img-thumbnail" src="'.asset('/view/image/' . $row['image'] ).'" alt="'. $row['name'].'" style="margin: 5px; width:50px; height:50px;"/>',
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
               // 'address' => $row['address'],
                'status' => ($row['status']===1) ? '
                   <span style="font-weight: 700;font-size: 80%;" class="badge badge-info"> Enabled</span>' : '
                      <span style="font-weight: 700;font-size: 80%;" class="badge badge-danger">Disabled</span>',
               // 'sort_order' => $row['sort_order'],
                'action' => '
                    <a href="' . route('manufacturers.edit', ['id' => $row['id']]) . '">
                             <span data-toggle="tooltip"  data-original-title="' . trans('manufacturer.tooltip_edit') . '" type="button" class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                    </a>&nbsp;
                    <span onclick="deleteItem(' . $row['id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('manufacturer.tooltip_delete') . '" class="btn btn-flat btn-danger">
                      <i class="fa fa-trash"></i>
                    </span>',
            ];
        }

        $optionSort= '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $optionRows = '';
        foreach ($arrRows as $key => $status) {
            $optionRows .= '<option  ' . (($show_rows == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['title'] = 'YemenMarket | Manufacturers';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.manufacturers.list');
        $data['buttonSort'] =  1; // 1 - Enable button sort;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('manufacturers.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.manufacturers.list') . '" id="button_search">
                   <div   onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="Refresh"><i class="fa  fa-search"></i></a></div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="Search" value="' . $keyword . '"> </div>
                   </div>
                </form>';


        Session::flash('breadcrumbs' , $breadcrumb);

   return view('admin.list')->with($data);
    }

    public function create()
       {
           $breadcrumb = [
               'buttons' => '  <button type="submit" form="form-manufacturers" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('manufacturer.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../manufacturers" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('manufacturer.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
               'heading_title' => ' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('manufacturer.heading_title_add'),
           ];
           $breadcrumb['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
               'href' => 'admin.home2'
           );

           $data = [
               'title'     => 'YemenMarket | Manufacturer Form',
               'action'    => url('admin/manufacturers/store'),

           ];
           Session::flash('breadcrumbs' , $breadcrumb);
           return view('admin.manufacturer_form')->with($data);

       }
    public function store(Request $request)
    {
        $data            = $request->all();

        $validator = Validator::make($data, $this->arrValidation($request->get('manufacturer_id')),   []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

       Manufacturer::create($request->only('image','name','email','phone','address','status','sort'));
        $success= 'the manufacturer created successfully' ;
        Session::flash('success' , $success);

        return redirect()->route('admin.manufacturers.list');
    }
    public function edit($id)
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-manufacturers" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('manufacturer.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../manufacturers" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('manufacturer.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('manufacturer.heading_title_edit'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );


        $manufacturer= Manufacturer::find($id);

        if ($manufacturer === null) {
            return 'no data';
        }

        $data = [
            'title'     => 'YemenMarket | manufacturer Form',
            'action'    => url('admin/manufacturers/update'),
            'manufacturer'    =>$manufacturer ,

              ];

        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.manufacturer_form')->with($data);
    }
    public function  update(Request $request)
    {
        $data               = $request->all();
        $manufacturer_id    = $request->get('manufacturer_id');
        $validator = Validator::make($data, $this->arrValidation($manufacturer_id),   []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $manufacturer = Manufacturer::find($manufacturer_id);
        $manufacturer->update( $request->except(['_token' , 'manufacturer_id']));
        $success= 'the manufacturer updated successfully' ;
        Session::flash('success' , $success);

        return redirect()->route('admin.manufacturers.list');
    }

    public function delete(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            //$arrID = array_diff(["21" , "22"], ["25" ,"24" , "23"]); // return ["21" , "22"]
            Manufacturer::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }
    public function arrValidation($id)
    {
        $arrValidation = [
            'image' => 'required',
            'name'=> 'required|string|max:100' ,
            'email'=>  'email|nullable|unique:manufacturers,email,'. $id. '',
            'sort' => 'numeric|min:0',
            'phone' => 'numeric|nullable',
            'address' => 'string|nullable',
        ];
        $arrMsg = [

        ];
        return $arrValidation ;
    }

}
