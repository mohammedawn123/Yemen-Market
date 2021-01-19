<?php

namespace App\Admin\Controllers;

use App\Attribute_group;
use App\Attribute_group_description;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

class AttributeGroupController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'buttons' => '   <a href="attribute_group/create/new"   class="btn btn-primary"  data-toggle="tooltip" data-original-title="'.trans('attribute_group.tooltip_add').'">
                                         <i class="fa fa-plus"></i>
                             </a>
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('attribute_group.tooltip_refresh').'">
                                          <i class="fa fa-refresh"></i>
                             </a>
                            ',
            'heading_title' => '<i class="fa fa-bar-chart"></i> '. trans('attribute_group.heading_title'),

        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $keyword = request('keyword') ?? '';
        $sort_order = request('sort_order') ?? 'id_desc';
        $show_rows = request('show_rows') ?? '10';
        $arrSort = [
            'attribute_group_id__desc'   => 'id_desc',
            'attribute_group_id__asc'    => 'id_asc',
            'name__desc' => 'name_desc',
            'name__asc'  => 'name_asc',
            'sort_order__desc' => 'sort_desc',
            'sort_order__asc'  => 'sort_asc',
        ];
        $arrRows =pagination_rows();
        $listTh = [
            'id'   => trans('attribute_group.column_id'),
            'name' =>trans('attribute_group.column_name'),
            'sort' => trans('attribute_group.column_sort'),
            'action' => trans('attribute_group.column_action'),
        ];

        $obj = new Attribute_group;
        $desc = (new Attribute_group_description)->getTable();

        $obj = $obj->leftjoin($desc, $desc.'.a_g_id' , $obj->getTable(). '.attribute_group_id')
                   ->where($desc.'.language_id' , session('language_id'));

        if ($keyword)
        {
          //  $obj = $obj->whereRaw('(attribute_group_id = ' . (int) $keyword . ' OR email like "%' . $keyword . '%" OR first_name like "%' . $keyword . '%" OR last_name like "%' . $keyword . '%"  )');
        }

        if ($sort_order && array_key_exists($sort_order, $arrSort))
        {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderby($field, $sort_field);
        }else
        {
            $obj = $obj->orderby('attribute_group_id', 'desc');
        }

        $dataTmp = $obj->paginate( $show_rows);
        $dataTr = [];

        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'id' => $row['attribute_group_id'],
                'name' => $row['name'],
                'sort' => $row['sort_order'],
                'action' => '
                    <a href="' . route('attribute_group.edit', ['id' => $row['attribute_group_id']]) . '">
                             <span data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_edit') . '" type="button" class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                    </a>&nbsp;
                    <span onclick="deleteItem(' . $row['attribute_group_id'] . ');"  data-toggle="tooltip"  data-original-title="' . trans('attribute_group.tooltip_delete') . '" class="btn btn-flat btn-danger">
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
        $data['title'] = 'YemenMarket | Attribute Group';
        $data['optionSort'] = $optionSort;
        $data['urlSort'] = route('admin.attribute_group.list');
        $data['buttonSort'] =  1; // 1 - Enable button sort;
        $data['optionRows'] = $optionRows;
        $data['urlDeleteItem'] = route('attribute_group.delete');
        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['urlDeleteItem'] = route('attribute_group.delete');
       $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.pagination');
        $data['resultItems'] = trans('pagination.page_show').' <b>' . $dataTmp->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$dataTmp->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $dataTmp->total(). '</b> '.trans('pagination.page_rows');

        Session::flash('breadcrumbs' , $breadcrumb);

   return view('admin.list')->with($data);
    }

    public function create()
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-attribute_group" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../attribute_group" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-plus" aria-hidden="true"></i> '.trans('attribute.heading_title_add'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $data = [
            'title'     => 'YemenMarket | Attribute Group Form',
            'action'    => url('admin/attribute_group/store'),
            'languages' => (new Language)->getList(),
            'attribute_group' =>'',
        ];
        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.attribute_group_form')->with($data);

    }
    public function store(Request $request)
    {
        $data            = $request->all();
        $sort_order      = $request->get('sort_order');
        $descriptions    = $request->get('descriptions');

        $validator = Validator::make($data, $this->arrValidation(),   []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        $attribute_group=Attribute_group::create([
            'sort_order'=>$sort_order,
        ]);
        $attribute_group->Attribute_group_description()->createMany($descriptions);
        return redirect()->route('admin.attribute_group.list');
    }
    public function edit($id)
    {
        $breadcrumb = [
            'buttons' => '  <button type="submit" form="form-attribute_group" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="'.trans('product.button_save').'"><i class="fa fa-save"></i></button>
                            <a href="../../attribute_group" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="'.trans('product.button_cancel').'"><i class="fa fa-reply"></i></a>
                               ',
            'heading_title' => ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> '.trans('attribute.heading_title_edit'),
        ];
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );


        $attribute_group = Attribute_group::find($id);

        if ($attribute_group === null) {
            return 'no data';
        }

        $data = [
            'title'     => 'YemenMarket | Attribute Group Form',
            'action'    => url('admin/attribute_group/update'),
            'languages' => (new Language)->getList(),
            'attribute_group' => $attribute_group,
        ];

        Session::flash('breadcrumbs' , $breadcrumb);
        return view('admin.attribute_group_form')->with($data);
    }
    public function  update(Request $request)
    {
        $data               = $request->all();
        $attribute_group_id = $request->get('attribute_group_id');
        $sort_order         = $request->get('sort_order');
        $descriptions       = $request->get('descriptions');

        $validator = Validator::make($data, $this->arrValidation(),   []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $attribute_group = Attribute_group::find($attribute_group_id);
        $attribute_group->Attribute_group_description()->delete();
        $attribute_group->Attribute_group_description()->createMany($descriptions);
        $attribute_group->update([
            'sort_order'=> $sort_order,
        ]);

        return redirect()->route('admin.attribute_group.list');
    }


    public function delete(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');             // return "21 , 22"
            $arrID = explode(',', $ids);         // return  ["21", "22"]
            //$arrID = array_diff(["21" , "22"], ["25" ,"24" , "23"]); // return ["21" , "22"]
            Attribute_group::destroy($arrID);
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
