<?php

namespace App\Admin\Controllers\Auth;

use App\Admin\Models\Admin;
use App\Http\Controllers\Controller;


use App\Admin\Models\Permission;
use App\Admin\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\DataTables;

class AdminUsersController extends Controller
{
      public function index()
         {
             $breadcrumb = [
                 'buttons'       => getTopButtons('users/create/new'),
                 'heading_title' =>  '<i class="fa fa-bar-chart"></i> ' . trans('user.heading_title'),
             ];
             $breadcrumb['breadcrumbs'][] = array(
                 'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
                 'href' => 'admin.home2'
             );
             Session::flash('breadcrumbs' , $breadcrumb);

             $keyword = request('keyword') ?? '';
             $sort_order = request('sort_order') ;
             $show_rows = request('show_rows') ?? '10';
             $status = request('status') ;
             $arrSort =
                 [
                 'id__desc'   => trans('user.id_desc'),
                 'id__asc'    => trans('category.id_asc'),
                 'name__desc'          => trans('category.name_desc'),
                 'name__asc'           => trans('category.name_asc'),
                 'status__desc'        => trans('category.status_desc'),
                 'status__asc'         => trans('category.status_asc'),

             ];
             $arrRows =pagination_rows();

             $listTh = [
                 'id'                 => trans('category.column_id'),
                 'photo'              => trans('user.column_photo'),
                 'name&email'         => trans('user.column_name_email'),
                 'roles'              => trans('user.column_roles'),
                 'permissions'        => trans('user.column_permissions'),
                 'status'             => 'Status',
                 'created_at'         => trans('user.column_created_at'),
                 'updated_at'         => trans('user.column_updated_at'),
                 'action'             => trans('user.column_action'),
             ];

             $obj = (new Admin);
             if ($keyword)
             {
                 $obj = $obj->where(function ($sql) use($keyword){
                     $sql->where('id',  $keyword )
                         ->orwhere('name', 'like', '%' . $keyword . '%')
                         ->orwhere('email',  'like', '%' . $keyword . '%');
                 });
             }
             if (isset($status))
             {
                 $obj = $obj->where('status' , $status);
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
                 $roles='';
                 $permissions='';
                 $flag1=0;
                 foreach ($row->roles as $role)
                 {
                     ($role->slug === 'administrator' || $role->slug === 'view.all') ? $flag1='style="pointer-events:none; "' : '' ;
                     $roles.='<span class="badge badge-info" style="background-color:#33b734 ; margin:1px;">'.$role->name.'</span>   ';
                 }
                 foreach ($row->permissions as $permission)
                 {
                     $permissions.='<span  class="badge badge-info" style="background-color:#33b734 ; margin:1px;">'.$permission->name.'</span>   ';
                 }
                 $dataTr[] = [
                     'id'        =>$row['id'],
                     'photo'     =>image_thumbnail($row['photo']),
                     'name'      => ' Name: <small style="font-weight: bolder;">'.$row['name'].'</small><br>
                                      Email: <small style="font-weight: bolder; color: blue; ">'.$row['email'].'</small>' ,
                     'roles'    => $roles  ,
                     'permissions'    => $permissions  ,
                     'status'    => getStatusColumn($row['status'])  ,
                     'created_at'    => $row['created_at'] ,
                     'updated_at'    =>$row['updated_at']  ,
                     'action'    => getActionColumn('admin.users.edit'  ,  $row['id'] , $flag1 ),
                 ];
             }

             $optionSort =  selectOptions($arrSort , $sort_order);
             $optionRows =  selectOptions($arrRows , $show_rows);

             $data['title'] = 'YemenMarket | Users';
             $data['optionSort'] = $optionSort;
             $data['urlSort'] = route('admin.users');
             $data['buttonSort'] =  1;
             $data['optionRows'] = $optionRows;
             $data['urlDeleteItem'] = route('admin.users.delete');
             $data['listTh'] = $listTh;
             $data['dataTr'] = $dataTr;
             $data['pagination']  = pagination($dataTmp)['pagination'];
             $data['resultItems'] = pagination($dataTmp)['resultItems'];
             $data['topMenuRight'][] ='
                <form action="' . route('admin.users') . '" class="button_search">
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


             return view('admin.list' , $data);

     }

    public function create()
    {
        $breadcrumbs['buttons']='  <button type="submit" form="user_form" data-toggle="tooltip" title="" class="btn btn-primary"                                    data-original-title="Save">
                              <i class="fa fa-save"></i>
                              </button>
        <a href="'.route('admin.users').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel">
        <i class="fa fa-reply"></i>
        </a>';

        $breadcrumbs['heading_title']=' <i class="fa fa-plus" aria-hidden="true"></i> '. trans('user.heading_title_add');
        $breadcrumbs['breadcrumbs'][] = array(
            'text' =>'<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $breadcrumbs['breadcrumbs'][] = array(
            'text' => trans('user.heading_title'),
            'href' => 'admin.users'
        );
        Session::flash('breadcrumbs' , $breadcrumbs);

        $action=url('admin/users/store_user') ;

        return view('admin.user_form' , ['action' => $action]);
    }
    public function store(Request $request)
    {
        $validator=$this->user_validation(
            $request->only(['name' , 'email' , 'password' ,'password_confirmation']) ,
            $request->get('user_id')
        );

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $user= Admin::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'status'=>$request->get('status'),
            'password'=>bcrypt($request->get('password'))
        ]);
        $roles=Role::find($request->get('user_roles'));
        $permissions=Permission::find($request->get('user_permissions'));

        $user->roles()->attach($roles);
        $user->permissions()->attach($permissions);

        $success= 'the user created successfully' ;
        Session::flash('success' , $success);
        return redirect()->route('admin.users');
    }

    public function edit($admin_id)
    {
        if(  request()->path()!=='admin/users/edit/'.Admin::user()->id && !Admin::user()->isAdministrator() )
        {
            $warning= 'you can not edit this user !' ;
            Session::flash('warning' , $warning);

            return redirect()->route('admin.home2');
        }
        else {

            $breadcrumbs['buttons'] = '  <button type="submit" form="user_form" data-toggle="tooltip" title="" class="btn btn-primary"                                    data-original-title="Save">
                              <i class="fa fa-save"></i>
                              </button>
                            <a href="'.route('admin.users').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel">
                                <i class="fa fa-reply"></i>
                             </a>';
            $breadcrumbs['heading_title'] = ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . trans('user.heading_title_edit');
            $breadcrumbs['breadcrumbs'][] = array(
                'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
                'href' => 'admin.home2'
            );
            $breadcrumbs['breadcrumbs'][] = array(
                'text' => trans('user.heading_title'),
                'href' => 'admin.users'
            );
            Session::flash('breadcrumbs', $breadcrumbs);

            $data=[
                'action'=>  url('admin/users/update_user'),
                'user'  =>  Admin::find($admin_id),
            ];


            return view('admin.user_form',$data);
        }


    }

    public function update(Request $request)
    {

        $validator = Validator::make( request()->all(), [
            'name' => 'required|regex:/(^([0-9A-Za-z@\._ ]+)$)/|unique:admins,name,' . $request->get('user_id') . '|string|max:100|min:3',
            'password' => 'nullable|string|max:60|min:6|confirmed',
            'email' => 'nullable|string|email|max:255|unique:admins,email,' . $request->get('user_id'),
        ], [
            'name.regex' => 'Only characters in the group: "A-Z", "a-z", "0-9" and ".@_" ',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user= Admin::find($request->get('user_id'));
        $user_data['user']=array();
        $user_data['user']['photo']=$request->get('image' );
        $user_data['user']['name']=$request->get('name' );
        $user_data['user']['email']=$request->get('email' );
        if($request->get('password' ) !== null)
        {
            $user_data['user']['password'] = bcrypt($request->get('password'));
        }

       $dataToUpdate=array_filter($user_data['user']);
       $dataToUpdate['status']= $request->get('status' );
       $user->update($dataToUpdate);

        $roles=Role::find($request->get('user_roles'));
        $permissions=Permission::find($request->get('user_permissions'));

        $user->roles()->sync($roles);
        $user->permissions()->sync($permissions);
        $success= 'the user updated successfully' ;
        Session::flash('success' , $success);

        if(!Admin::user()->isAdministrator() )
        {
            return redirect()->route('admin.home2');
        }
      return redirect()->route('admin.users');
    }


    public function users_autocomplete(Request $request)
    {

        $users=Admin::select('*');
        if($request->get('filter_name'))
            $users->where('name' , 'LIKE' , '%'.$request->get('filter_name').'%') ;


        return  Response()->json($users->get());
    }

    public function roles_autocomplete(Request $request)
    {
        $roles=Role::select('*')->get();
        return  Response()->json($roles);
    }

    public function  permission_autocomplete(Request $request)
    {
        $permission=Permission::select('*');
        if($request->get('filter_name'))
            $permission->where('name' , 'LIKE' , '%'.$request->get('filter_name').'%') ;

        return  Response()->json($permission->get());
    }

    public function  DeleteUser(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            $arrID = array_diff($arrID, ["1"]); // not delete Administrator1 user
             Admin::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }

    protected function user_validation($data , $id)
    {
        $rules= [
            'name'=> 'required|min:3|max:50' ,
             'email'=>  'required|email|unique:admins,email,'. $id. '',
            'password'=>'min:6|required_with:password_confirmation',
             'password_confirmation'=>'same:password'
        ];

        $messages= [
            'required'=> 'هذا الحقل مطلوب' ,
            'name.min'=> 'هذا الحقل يجب ان يحتوي على الاقل 3 احرف' ,
            'name.max'=> 'هذا الحقل يجب ان لا يزيد على 50 حرف' ,
            'email.email'=> 'هذا الحقل يجب ان يكون بصيغة الإميل' ,
            'email.unique'=> 'هذا الإميل موجود مسبقا..' ,
            'password.min'=> 'يجب ان يكون عدد احرف هذا الحقل على الاقل  6 احرف' ,
            'password_confirmation.min'=> 'يجب ان يكون عدد احرف هذا الحقل على الاقل  6 احرف' ,
            'password_confirmation.same'=> 'The password confirmation does not match . ' ,


        ];
        return Validator::make($data , array_filter($rules) , $messages);

     }


}
