<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Mcategory ;
use App\Category_description ;
use App\Category_path ;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validation , Redirect,Response;
use Datatables;
use Input ;

class CategoriesController extends Controller
{

public function index()
    {
        $breadcrumb = [
            'buttons'       => getTopButtons('categories/create/new'),
            'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('category.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ;
        $show_rows = request('show_rows') ?? '10';
        $status = request('status') ;
        $arrSort = [
            'category_id__desc'   => trans('category.id_desc'),
            'category_id__asc'    => trans('category.id_asc'),
            'name__desc'          => trans('category.name_desc'),
            'name__asc'           => trans('category.name_asc'),
            'status__desc'        => trans('category.status_desc'),
            'status__asc'         => trans('category.status_asc'),
            'sort_order__desc'    => trans('category.sort_desc'),
            'sort_order__asc'     => trans('category.sort_asc'),


        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'                 => trans('category.column_id'),
            'image'              => trans('category.column_image'),
            'name'               => trans('category.column_name'),
            'status'             => trans('category.column_status'),
            'sort_order'         => trans('category.column_sort_order'),
            'action'             => trans('category.column_action'),
        ];
        $filter = array(
            'keyword'     => $keyword,
            'sort_order'  => $sort_order,
            'arrSort'     => $arrSort,
            'paginate'    => $show_rows,
             'whereOpt'    => array(

                                     'status'    => $status ?? 1
                                  )

        );



        $dataTmp = (new Mcategory)->getAllCategories($filter) ;

        $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
          $parent=(new Mcategory)->getCategory($row->parent_id)->get()->toarray();
            $dataTr[] = [
                'id'        =>$row->category_id,
                'image'     =>image_thumbnail($row->image),
                'name'      =>  $row->parent_id ? $parent[0]['name'] .' > ' .'<b>'.$row->name.'</b>' : $row->name,
                'status'    => getStatusColumn($row->status)  ,
                'sort_order'=> $row->sort_order ,
                'action'    => getActionColumn('admin.categories.edit'  ,  $row->category_id ),
            ];
        }

        $optionSort =  selectOptions($arrSort , $sort_order);
        $optionRows =  selectOptions($arrRows , $show_rows);

        $data['title'] = 'YemenMarket | Categories';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.categories.list');
        $data['buttonSort'] =  1;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('admin.categories.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']  = pagination($dataTmp)['pagination'];
        $data['resultItems'] = pagination($dataTmp)['resultItems'];
        $data['topMenuRight'][] ='
                <form action="' . route('admin.categories.list') . '" class="button_search">
                    <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="'.trans('list.button_search').'"><i class="fa  fa-search"></i></a>
                    </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control search" placeholder="'.trans('list.button_search').'" value="' . $keyword . '">
                            </div>
                   </div>

                  <div class="btn-group pull-left">
                         <div class="form-group">
                           <select class="form-control" name="status" id="status">
                           <option value=""  >' .trans('category.text_all').'</option>
                          <option value="1" ' . (($status === 1) ? "selected" : "").'>  ' .trans('list.text_enabled').' </option>
                          <option value="0"  ' . (($status === 0) ? "selected" : "").'>'.trans('list.text_disabled').'</option>
                        </select> </div>
                   </div>
                </form> ';


        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.list')->with($data);
    }


public function create()
    {


        $breadcrumb['buttons']='  <button type="submit" form="form-category" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
                           <a href="'.route('admin.categories.list').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                           ';
        $breadcrumb['heading_title']=' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('category.heading_title_add');
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => trans('category.heading_title'),
            'href' => 'admin.categories.list'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $data = [
            'title'     => 'YemenMarket | Category Form',
            'action'    => url('admin/categories/store'),
            'languages' => (new Language)->getList(),
        ];

        return view('admin.category_form')->with($data );
    }


public function store(Request $request)
    {
         $inputs=$request->input();

         if($inputs['parent_id'] == "0") { $top="1"; }  else { $top="0"; }
         $inputs['top']=$top ;

        $category=  Mcategory::create($inputs);
        $category_id =$category->category_id;
        $category->Category_description()->createMany($inputs['category_description']);

        $level = 0;
        $category_paths = Category_path::where('category_id' , $inputs['parent_id'] )
            ->orderBy('level' , 'ASC')->get() ;
        foreach ($category_paths as $CategoryPath)
        {
            $category->Categorypath()->create([
                'path_id'=> $CategoryPath->path_id ,
                'level'=>   $level
                 ]);
            $level++;
        }
        $category->Categorypath()->create([
            'path_id'=> $category_id ,
            'level'=>   $level
        ]);

        $success= 'the Category created successfully' ;
         Session::flash('success' , $success);
    return redirect()->route('admin.categories.list');
    }


public function edit($category_id)
    {

        $breadcrumb['buttons']='  <button type="submit" form="form-category" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
                                  <a href="'.route('admin.categories.list').'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                                                 ';
        $breadcrumb['heading_title']=' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('category.heading_title_edit');
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => trans('category.heading_title'),
            'href' => 'admin.categories.list'
        );
        Session::flash('breadcrumbs' , $breadcrumb);


        $category=Mcategory::find($category_id);
        if ($category === null) {
            return 'no data';
        }


        $category_description=$category->Category_description()->get()->keyby('language_id')->toArray();
        $parent_category=$category->Parent_category()->where('language_id' , session('language_id') )->get()->toArray();
        $category['category_description']=$category_description;
        $category['parent_category']=$parent_category;

        $data = [
            'title'     => 'YemenMarket | Category Form',
            'action'    => url('admin/categories/update'),
            'languages' => (new Language)->getList(),
            'Category'  => $category,
        ];

 return view('admin.category_form')->with($data);
 }

public function update(Request $request)
    {
        $category=$request->only(['category_id' , 'path','parent_id','image','top','column','sort_order' , 'status' ]);
        $category_descriptions=$request->get('category_description');

        $category['id']= $category['category_id'];
        if($category['path']==null ||   $category['parent_id']=="0")
        {
            $category['top'] = "1";
            $category['parent_id'] = "0";
        }

        $cat= Mcategory::find( $category['category_id']  );
        $cat->update($category);
        $cat->Category_description()->delete();
        $cat->Category_description()->createMany($category_descriptions);

      $Category_path=$cat->Categorypath->where('path_id' ,$category['category_id'] );

             if ($Category_path)
                {
                  foreach ($Category_path as $c_path)
                         {
                          // Delete the path below the current one
                             Category_path::where([
                              ['category_id' , '=' , $c_path->category_id  ] ,
                              ['level' , '<' , $c_path->level  ]
                               ])->delete();

                             $path = array();
                             // Get the nodes new parents
                             $Category_parent=Category_path::where('category_id' , $category['parent_id'])->orderBy('level' , 'ASC')->get();

                             foreach ($Category_parent as $result)
                                  {   $path[] = $result->path_id;  }

                               // Get whats left of the nodes current path
                                 $Category_left= Category_path::where('category_id' ,$c_path->category_id )->orderBy('level' , 'ASC')->get();
                                  foreach ($Category_left as $result)
                                  {  $path[] = $result->path_id; }

                                  // Combine the paths with a new level
                                     Category_path::where(['category_id' => $c_path->category_id])->delete();
                                    foreach ($path as $key => $path_id)
                                     {
                                        Category_path::updateOrCreate(
                                             ['category_id'=>  $c_path->category_id ,
                                               'path_id'=> $path_id , 'level'=>  $key.PHP_EOL ] );
                                     }

                         }
               }

         $message= 'the category updated successfully' ;
         Session::flash('success' , $message);

        return redirect()->route('admin.categories.list');
    }


public function autocomplete(Request $request)
    {
         $filter = array(
                         'keyword'     =>  $request->get('filter_name'),
                         'limit'       => 5 ,
                         'whereOpt'    => array('status' => $status ?? 1  ,  'parent_id' => 0  )
                   );

        $Categories = (new Mcategory)->getAllCategories($filter) ;

   return  Response()->json($Categories);

    }




public function delete()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]

            foreach ($arrID as $id)
            {
                $this->destroy($id);
            }

            $success= 'the category / categories  Deleted successfully' ;
            return response()->json(['error' => 0, 'msg' =>$success]);
        }

    }
 public function destroy($category_id)
    {
        $category=Mcategory::find($category_id);
        if(isset($category) && $category->count() > 0)
        {
                $childs = $category->childs_of_category()->get();
                foreach ($childs as $child)
                   {
                     $this->destroy($child->category_id);
                   }
            $category->delete();
        }

    }


}







