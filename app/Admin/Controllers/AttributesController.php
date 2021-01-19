<?php

namespace App\Admin\Controllers;

use App\Attribute;
use App\Attribute_description;
use App\Attribute_group;
use App\Attribute_group_description;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AttributesController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'buttons' => '   <a href="attributes/create/new"   class="btn btn-primary"  data-toggle="tooltip" data-original-title="'.trans('attribute.tooltip_add').'">
                                         <i class="fa fa-plus"></i> </a>
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('attribute.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>
                           ',
            'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('attribute.heading_title'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ?? 'id_desc';
        $show_rows = request('show_rows') ?? '10';
        $arrSort = [
            'attribute_id__desc'   => 'id_desc',
            'attribute_id__asc'    => 'id_asc',
            'attribute_descriptions.name__desc' => 'name_desc',
            'attribute_descriptions.name__asc'  => 'name_asc',
            'sort_order__desc' => 'sort_desc',
            'sort_order__asc'  => 'sort_asc',
        ];
        $arrRows =pagination_rows();

        $listTh = [
            'id'             => trans('attribute.column_id'),
            'attribute_name' => trans('attribute.column_name'),
            'sort'           => trans('attribute.column_sort'),
            'action'         => trans('attribute.column_action'),
        ];

        $obj = new Attribute_group;
        $desc = (new Attribute_group_description)->getTable();
        $obja = (new Attribute)->getTable();
        $desca = (new Attribute_description)->getTable();
        $obj =  $obj->leftjoin($desc, $desc.'.a_g_id' , $obj->getTable(). '.attribute_group_id')
                    ->leftjoin($obja , $obja.'.attribute_group_id' , $obj->getTable(). '.attribute_group_id')
                    ->leftjoin($desca , $desca.'.attribute_id' , $obja. '.attribute_id')
                    ->select($obja. '.attribute_group_id' , $obja. '.attribute_id', $obja. '.sort_order'  ,$desc.'.name as group_name',$desca.'.name as attribute_name' )
                    ->where($desc.'.language_id' , session('language_id'))
                    ->where($desca.'.language_id' , session('language_id'));

        if ($keyword)
        {
            $obj = $obj->where(function ($sql) use($desca,$desc , $keyword){
                   $sql->where($desca . '.name', 'like', '%' . $keyword . '%')
                       ->orwhere($desc . '.name', 'like', '%' . $keyword . '%')
                       ->orwhere($desca.'.attribute_id',  $keyword );
            });
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderby($field, $sort_field);
        }else
            {
              $obj = $obj->orderby('attribute_id', 'desc');
            }

         $dataTmp = $obj->paginate($show_rows);
         $dataTr = [];

        foreach ($dataTmp as $key => $row)
        {
            $dataTr[] = [
                'id' => $row['attribute_id'],
                'name' => $row['group_name'].' > ' .$row['attribute_name'],
                'sort_order' => $row['sort_order'],
                'action' => '
                    <a href="' . route('attributes.edit', ['id' => $row['attribute_id']]) . '">
                             <span data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_edit') . '" type="button" class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                    </a>&nbsp;
                    <span onclick="deleteItem(' . $row['attribute_id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_delete') . '" class="btn btn-flat btn-danger">
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

        $data['title'] = 'YemenMarket | Attributes';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.attributes.list');
        $data['buttonSort'] =  1; // 1 - Enable button sort;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('attributes.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination']= $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');
        $data['topMenuRight'][] ='
                <form action="' . route('admin.attributes.list') . '" class="button_search">
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
               'buttons' => '  <button type="submit" form="form-attributes" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../attributes" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
               'heading_title' => ' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('attribute.heading_title_add'),
           ];
           $breadcrumb['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
               'href' => 'admin.home2'
           );

           $data = [
               'title'     => 'YemenMarket | Attribute Form',
               'action'    => url('admin/attributes/store'),
               'languages' => (new Language)->getList(),
               'attribute' => '',
               'attribute_groups' => (new Attribute_group)->getList(),
           ];
           Session::flash('breadcrumbs' , $breadcrumb);
           return view('admin.attribute_form')->with($data);

       }
    public function store(Request $request)
    {
        $data            = $request->all();
        $attribute_group = $request->get('attribute_group');
        $sort_order      = $request->get('sort_order');
        $descriptions    = $request->get('descriptions');

        $validator = Validator::make($data, $this->arrValidation(),   []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        $attribute=Attribute::create([
            'sort_order'=>$sort_order,
            'attribute_group_id'=>$attribute_group ,
        ]);
        $attribute->Attribute_description()->createMany($descriptions);
        return redirect()->route('admin.attributes.list');
    }
    public function edit($id)
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-attributes" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../attributes" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('attribute.heading_title_edit'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );


        $attribute = Attribute::find($id);

        if ($attribute === null) {
            return 'no data';
        }

        $data = [
            'title'     => 'YemenMarket | Attribute Form',
            'action'    => url('admin/attributes/update'),
            'languages' => (new Language)->getList(),
            'attribute' => $attribute,
            'attribute_groups' => (new Attribute_group)->getList(),
              ];

        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.attribute_form')->with($data);
    }
    public function  update(Request $request)
    {
        $data               = $request->all();
        $attribute_id       = $request->get('attribute_id');
        $attribute_group = $request->get('attribute_group');
        $sort_order         = $request->get('sort_order');
        $descriptions    = $request->get('descriptions');

        $validator = Validator::make($data, $this->arrValidation(),   []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $attribute = Attribute::find($attribute_id);
        $attribute->Attribute_description()->delete();
        $attribute->Attribute_description()->createMany($descriptions);
        $attribute->update([
            'attribute_group_id'=>$attribute_group,
            'sort_order'=> $sort_order,
        ]);

        return redirect()->route('admin.attributes.list');
    }

    public function delete()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            //$arrID = array_diff(["21" , "22"], ["25" ,"24" , "23"]); // return ["21" , "22"]
            Attribute::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);
        }

    }
    public function arrValidation()
    {
        $arrValidation = [
            'sort_order' => 'numeric|min:0',
            'descriptions.*.name' => 'required',
        ];
        $arrMsg = [

        ];
        return $arrValidation ;
    }

}
