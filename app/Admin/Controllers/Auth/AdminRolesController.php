<?php

namespace App\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Admin\Models\Admin;
use App\Admin\Models\Permission;
use App\Admin\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminRolesController extends Controller
{
      public function index()
         {
             $breadcrumb = [
                 'buttons'       => getTopButtons('roles/create_role'),
                 'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('role.heading_title'),
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
                     'id__asc'    => trans('category.id_asc'),
                     'name__desc'          => trans('category.name_desc'),
                     'name__asc'           => trans('category.name_asc'),
                     'slug__desc'        => 'Slug_desc',
                     'slug__asc'         => 'Slug_asc',

                 ];
             $arrRows =pagination_rows();

             $listTh = [
                 'id'                 => trans('category.column_id'),
                 'name'              => trans('role.column_name'),
                 'slug'         => trans('role.column_slug'),
                 'permissions'        => trans('role.column_permissions'),
                 'created_at'         => trans('role.column_created_at'),
                 'updated_at'         => trans('role.column_updated_at'),
                 'action'             => trans('role.column_action'),
             ];

             $obj = (new Role);
             if ($keyword)
             {
                 $obj = $obj->where(function ($sql) use($keyword){
                     $sql->where('id',  $keyword )
                         ->orwhere('name', 'like', '%' . $keyword . '%')
                         ->orwhere('slug',  'like', '%' . $keyword . '%');
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
                 $permissions='';
                 foreach ($row->permissions as $permission)
                 {
                     $permissions.='<span  class="badge badge-info" style="background-color:#33b734 ; margin:1px;">'.$permission->name.'</span>   ';
                 }
                 $dataTr[] = [
                     'id'            =>$row['id'],
                     'name'          =>$row['name'],
                     'slug'          =>$row['slug'],
                     'permissions'   => $permissions  ,
                     'created_at'    => $row['created_at'] ,
                     'updated_at'    =>$row['updated_at']  ,
                     'action'        => getActionColumn('admin.roles.edit'  ,  $row['id']  ),
                 ];
             }

             $optionSort =  selectOptions($arrSort , $sort_order);
             $optionRows =  selectOptions($arrRows , $show_rows);

             $data['title'] = 'YemenMarket | User Groups';
             $data['optionSort'] = $optionSort;
             $data['urlSort'] = route('admin.roles.list');
             $data['buttonSort'] =  1;
             $data['optionRows'] = $optionRows;
             $data['urlDeleteItem'] = route('admin.roles.delete');
             $data['listTh'] = $listTh;
             $data['dataTr'] = $dataTr;
             $data['pagination']  = pagination($dataTmp)['pagination'];
             $data['resultItems'] = pagination($dataTmp)['resultItems'];
             $data['topMenuRight'][] ='
                <form action="' . route('admin.roles.list') . '" class="button_search">
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

    public function create()
    {

        $breadcrumbs['buttons']='  <button type="submit" form="role_form" data-toggle="tooltip" title="" class="btn btn-primary"  data-original-title="Save">
                              <i class="fa fa-save"></i>
                              </button>
        <a href="'.route('admin.roles.list').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel">
        <i class="fa fa-reply"></i>
        </a>';

        $breadcrumbs['heading_title']='<i class="fa fa-plus" aria-hidden="true"></i>'. trans('role.heading_title_add');


        $breadcrumbs['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $breadcrumbs['breadcrumbs'][] = array(
            'text' =>  trans('role.heading_title'),
            'href' => 'admin.roles.list'
        );

        Session::flash('breadcrumbs' , $breadcrumbs);

        $data=[
            'action'=> url('admin/roles/store_role') ,
        ];

   return view('admin.role_form' , $data);

    }
    public function store(Request $request)
    {
        $rules= [
            'name'=> 'required|min:3|max:50|unique:roles,name',
            'slug'=> 'required|min:3|max:50|unique:roles,slug'
        ];

        $validator= Validator::make(
            $request->only(['name', 'slug' ])  ,
            $rules ,
            $this->messages()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $role= Role::create([
            'name'=>$request->get('name'),
            'slug'=>$request->get('slug')
            ]);
        $permissions=Permission::find($request->get('role_permissions'));
        $users=Admin::find($request->get('role_users'));

        $role->permissions()->attach($permissions);
        $role->users()->attach($users);

        $success= 'the role created successfully' ;
        Session::flash('success' , $success);
        return redirect()->route('admin.roles.list');
    }
    public function edit($id)
    {
        $breadcrumbs['buttons']='  <button type="submit" form="role_form" data-toggle="tooltip" title="" class="btn btn-primary"                                    data-original-title="Save">
                              <i class="fa fa-save"></i>
                              </button>
        <a href="'.route('admin.roles.list').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel">
        <i class="fa fa-reply"></i>
        </a>';

        $breadcrumbs['heading_title']=' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('role.heading_title_edit');
        $breadcrumbs['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumbs['breadcrumbs'][] = array(
            'text' => trans('role.heading_title'),
            'href' => 'admin.roles.list'
        );
        Session::flash('breadcrumbs' , $breadcrumbs);
        $role=Role::find($id);

      $data=[
              'action'=> url('admin/roles/update_role'),
              'role'=> $role,
           ];

   return view('admin.role_form' , $data);
    }

    public function update(Request $request)
    {

        $rules= [
                  'name'=> 'required|min:3|max:50|unique:roles,name,'. $request->get('role_id'),
                  'slug'=> 'required|min:3|max:50|unique:roles,slug,'.$request->get('role_id')
               ];

        $validator= Validator::make(
                                       $request->only(['name', 'slug' ])  ,
                                       $rules ,
                                       $this->messages()
                                    );

         if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

        $role= Role::find($request->get('role_id'));

        $role->update([
                       'name'=>$request->get('name' ) ,
                       'slug'=>$request->get('slug' )
                   ]);

        $permissions=Permission::find($request->get('role_permissions'));
        $users=Admin::find($request->get('role_users'));

        $role->permissions()->sync($permissions);
        $role->users()->sync($users);
        $success= 'the role updated successfully' ;
        Session::flash('success' , $success);
      return redirect()->route('admin.roles.list');
    }

    public function  DeleteRole(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            $arrID = array_diff($arrID, ["1"]); // not delete Administrator role
             Role::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }

    }
    public function  permission_autocomplete(Request $request)
    {
        $permission=Permission::select('*');
        if($request->get('filter_name'))
            $permission->where('name' , 'LIKE' , '%'.$request->get('filter_name').'%') ;

        return  Response()->json($permission->get());
    }

    protected function messages( )
    {

         return [
            'name.required'=> 'The name field is required. ' ,
            'slug.required'=> 'The slug field is required. ' ,
            'name.min'=> ' The name must be at least 3 characters. ' ,
            'slug.min'=> ' The slug must be at least 3 characters. ' ,
            'slug.max'=> 'The slug may not be greater than 50 characters. ' ,
            'name.max'=> 'The name may not be greater than 50 characters. ' ,
            'name.unique'=> 'The name has already been taken. .' ,
            'slug.unique'=> 'The slug has already been taken. ' ,

        ];

     }


}
