<?php

namespace App\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Admin\Models\Admin;

use App\Admin\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AdminPermissionController extends Controller
{
    public $routeAdmin;

    public function __construct()
    {
        $routes = app()->routes->getRoutes();
        foreach ($routes as $k=>$value) {
            if (\Illuminate\Support\Str::startsWith($value->getPrefix(), 'admin')) {
                $prefix = $value->getPrefix();
                $this->routeAdmin[$prefix] = [
                    'key' => $k+2,
                    'uri' => 'ANY::' . $prefix . '/*',
                    'name' => $prefix . '/*',
                    'method' => 'ANY',
                    'flag' => 0,
                ];
                foreach ($value->methods as $key => $method) {
                    if ($method != 'HEAD' && !collect($this->without())->first(function ($exp) use ($value) {
                            return Str::startsWith($value->uri, $exp);
                        })) {
                        $this->routeAdmin[$k] = [
                            'key' => $k,
                            'uri' => $method . '::' . $value->uri,
                            'name' => $value->uri,
                            'method' => $method,
                            'flag' => 0,
                        ];
                    }

                }
            }

        }
        return $this->routeAdmin;
    }
      public function index()
         {

             $breadcrumb = [
                 'buttons'       => getTopButtons('permission/create_permission'),
                 'heading_title' =>  '<i class="fa fa-bar-chart"></i> '.trans('permission.heading_title'),
             ];
             $breadcrumb['breadcrumbs'][] = array(
                 'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
                 'href' => 'admin.home2'
             );
             Session::flash('breadcrumbs' , $breadcrumb);

             $keyword = request('keyword') ?? '';
             $sort_order = request('sort_order') ;
             $show_rows = request('show_rows') ?? '10';

             $arrSort =
                 [
                     'id__desc'   => trans('user.id_desc'),
                     'id__asc'    => trans('user.id_asc'),
                     'name__desc'          => trans('category.name_desc'),
                     'name__asc'           => trans('category.name_asc'),
                     'slug__desc'        => 'Slug_desc',
                     'slug__asc'         => 'Slug_asc',
                     'http_uri__desc'        => 'uri_desc',
                     'http_uri__asc'         => 'uri_asc',

                 ];
             $arrRows =pagination_rows();

             $listTh = [
                 'id'                 => trans('category.column_id'),
                 'name'               => trans('permission.column_name'),
                 'slug'               => trans('permission.column_slug'),
                 'http_path'          => trans('permission.column_http_path'),
                 'created_at'         => trans('permission.column_created_at'),
                 'updated_at'         => trans('permission.column_updated_at'),
                 'action'             => trans('permission.column_action'),
             ];

             $obj= new Permission;
             if ($keyword)
             {
                 $obj = $obj->where(function ($sql) use($keyword){
                     $sql->where('id',  $keyword )
                         ->orwhere('name', 'like', '%' . $keyword . '%')
                         ->orwhere('slug',  'like', '%' . $keyword . '%')
                         ->orwhere('http_uri',  'like', '%' . $keyword . '%');
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
             foreach ($dataTmp as $key => $row) {
                 $permissions = '';
                 if ($row['http_uri']) {
                     $methods = array_map(function ($value) {
                         $route = explode('::', $value);
                         $methodStyle = '';
                         if ($route[0] === 'ANY') {
                             $methodStyle = '<span class="label label-info">' . $route[0] . '</span>';
                         } else
                             if ($route[0] === 'POST') {
                                 $methodStyle = '<span class="label label-warning">' . $route[0] . '</span>';
                             } else {
                                 $methodStyle = '<span class="label label-primary">' . $route[0] . '</span>';
                             }
                         return $methodStyle . ' <code>' . $route[1] . '</code>';
                     }, explode(',', $row['http_uri']));
                     $permissions = implode('<br>', $methods);
                 }
                 $dataTr[] = [
                     'id' => $row['id'],
                     'name' => $row['name'],
                     'slug' => $row['slug'],
                     'http_path' => $permissions,
                     'created_at' => $row['created_at'],
                     'updated_at' => $row['updated_at'],
                     'action' =>getActionColumn('admin.permission.edit'  ,  $row['id']  ),

                   ];
             }
             $optionSort =  selectOptions($arrSort , $sort_order);
             $optionRows =  selectOptions($arrRows , $show_rows);

             $data['title'] = 'YemenMarket | User Permissions';
             $data['optionSort'] = $optionSort;
             $data['urlSort'] = route('admin.permission.list');
             $data['buttonSort'] =  1;
             $data['optionRows'] = $optionRows;
             $data['urlDeleteItem'] = route('admin.permission.delete');
             $data['listTh'] = $listTh;
             $data['dataTr'] = $dataTr;
             $data['pagination']  = pagination($dataTmp)['pagination'];
             $data['resultItems'] = pagination($dataTmp)['resultItems'];
             $data['topMenuRight'][] ='
                <form action="' . route('admin.permission.list') . '" class="button_search">
                    <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="Refresh"><i class="fa  fa-search"></i></a>
                    </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control search" placeholder="Search" value="' . $keyword . '">
                            </div>
                   </div>
                </form> ';

    return view('admin.list' , $data) ;
   }
    public function without()
    {
        $prefix = 'admin'.'/';
        return [
            $prefix . 'login',
            $prefix . 'logout',
            $prefix . 'forgot',
            $prefix . 'deny',
            $prefix . 'locale',
            $prefix . 'uploads',
        ];
    }
   public function create()
    {
        $breadcrumbs['buttons']='  <button type="submit" form="permission_form" data-toggle="tooltip" class="btn btn-primary"  data-original-title="Save">
                              <i class="fa fa-save"></i>
                              </button>
        <a href="../permission" data-toggle="tooltip"  class="btn btn-default" data-original-title="Cancel">
        <i class="fa fa-reply"></i>
        </a>';

        $breadcrumbs['heading_title']=' <i class="fa fa-plus" aria-hidden="true"></i> '.  trans('permission.heading_title_add');
        $breadcrumbs['panel-title']='Create a new permission';
        $breadcrumbs['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $breadcrumbs['breadcrumbs'][] = array(
            'text' => trans('permission.heading_title'),
            'href' => 'admin.permission.list'
        );

        Session::flash('breadcrumbs' , $breadcrumbs);
        $action=url('admin/permission/store_permission') ;

     return view('admin.permission_form' )->with(['action'=>$action]);
    }
    public function store(Request $request)
    {
        $validator= Validator::make(
            $request->only(['name', 'slug' ])  ,
            $this->rules($request->get('permission_id')) ,
            $this->messages()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $permission= Permission::find($request->get('permission_id'));


        $permission= Permission::create([
            'name'=>$request->get('name' ) ,
            'slug'=>$request->get('slug' ),
            'http_uri'=> implode(',', ($request->get('permission_paths' ) ?? [])),
            ]);

        $success= 'the permission created successfully' ;
        Session::flash('success' , $success);
        return redirect()->route('admin.permission.list');
    }

    public function edit($id)
    {
        $breadcrumbs['buttons']='  <button type="submit" form="permission_form" data-toggle="tooltip" title="" class="btn btn-primary"                                    data-original-title="Save">
                              <i class="fa fa-save"></i>
                              </button>
        <a href="../../permission" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel">
        <i class="fa fa-reply"></i>
        </a>';
        $breadcrumbs['heading_title']=' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.  trans('permission.heading_title_edit');
        $breadcrumbs['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumbs['breadcrumbs'][] = array(
            'text' => trans('permission.heading_title'),
            'href' => 'admin.permission.list'
        );
        Session::flash('breadcrumbs' , $breadcrumbs);

        $permission=Permission::find($id);
        $action=url('admin/permission/update_permission') ;

       $data=[
           'action'=>$action,
           'permission'=>$permission,
           'routeAdmin'=>$this->routeAdmin
       ];


    return view('admin.permission_form' , $data);
    }

    public function update(Request $request)
    {
        $validator= Validator::make(
            $request->only(['name', 'slug' ])  ,
            $this->rules($request->get('permission_id')) ,
            $this->messages()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $permission= Permission::find($request->get('permission_id'));

        $permission->update([
            'name'=>$request->get('name' ) ,
            'slug'=>$request->get('slug' ),
            'http_uri'=> implode(',', ($request->get('permission_paths' ) ?? [])),
        ]);

        $success= 'the permission updated successfully' ;
        Session::flash('success' , $success);
        return redirect()->route('admin.permission.list');

    }

    public function  DeletePermission(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            permission::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }

    public function   routeAdmin_autocomplete(Request $request)
    {
        $routes=$this->routeAdmin;
        $return=array();
        $find=$request->get('filter_name');
        $old_http_uri=$request->get('old_http_uri');

         foreach ($routes as $key=>$route)
            {
                if(!empty($old_http_uri) && in_array( $route['uri'] , $old_http_uri  ))
                    $route['flag']=1 ;

                 if(preg_match( "/{$find}/i"  , $route['uri'] ) )
                     $return[$key]=$route ;
            }

        return  Response()->json($return );
    }
    protected function rules($permission_id)
      {
        return[
            'name'=> 'required|string|max:50|unique:permissions,name,'. $permission_id. '',
            'slug'=> 'required|regex:/(^([0-9A-Za-z\._\-]+)$)/|unique:permissions,slug,'.$permission_id. '|string|max:50|min:3',
        ];

      }
    protected function messages()
      {

         return [
            'name.required'=> 'The name field is required. ' ,
            'slug.required'=> 'The slug field is required. ' ,
            'slug.min'=> ' The slug must be at least 3 characters. ' ,
            'slug.max'=> 'The slug may not be greater than 50 characters. ' ,
            'name.max'=> 'The name may not be greater than 50 characters. ' ,
            'name.unique'=> 'The name has already been taken. .' ,
            'slug.unique'=> 'The slug has already been taken. ' ,

        ];

     }


}
