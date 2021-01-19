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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Validation , Redirect,Response;
use Datatables;
use Input ;

class LanguagesController extends Controller
{

    public function index()
    {
        $data=[
            'buttons'=>'   <a href="languages/create/new" data-toggle="tooltip"  class="btn btn-primary" data-original-title="Add New">
                             <i class="fa fa-plus"></i></a>
                           <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="Rebuild">
                             <i class="fa fa-refresh"></i></a>
                           <button type="button" data-toggle="tooltip"  class="btn  btn-danger grid-trash" data-original-title="Delete">
                             <i class="fa fa-trash-o" ></i></button> ',
            'heading_title'=>'<i class="fa fa-bar-chart"></i> '.trans('language.heading_title'),

              ] ;
        $data['breadcrumbs'][] = array(
            'text' =>'<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );

        $languages=Language::select('*')->get();
        $dataTr = [];
        foreach ($languages as $row)
        {
            $dataTr[] = [
                'language_id' => $row['language_id'],
                'image' => $row['image'],
                'name' => $row['name'],
                'code' => $row['code'],
                'status' => $row['status'],
                'direction' => $row['directory'],
                'sort' => $row['sort'],
                'action' => '<a href="' . route('admin.languages.edit', ['code' => $row['code']]) . '"  >
                    <span    type="button" data-toggle="tooltip" data-original-title="Edit" class="btn btn-flat btn-primary">
                    <i class="fa fa-pencil"></i></span></a>&nbsp;
                    <span  onclick="deleteItem(' . $row['language_id'] . ');" data-toggle="tooltip" data-original-title="Delete"  class="btn btn-danger">
                    <i class="fa fa-trash"></i></span>',

            ];

        }
        Session::flash('breadcrumbs' , $data);
        return view('admin.languages_list' , ['languages'=>$dataTr]) ;
    }

    public function Create()
    {
        $action = url('admin/languages/store');

        $data['buttons'] = '  <button type="submit" form="form-language" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="' . trans('product.button_save') . '"><i class="fa fa-save"></i></button>
        <a href="../../languages" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="' . trans('product.button_cancel') . '"><i class="fa fa-reply"></i></a>
       ';
        $data['heading_title'] = ' <i class="fa fa-plus" aria-hidden="true"></i> ' . trans('language.heading_title_add');
        $data['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $data['breadcrumbs'][] = array(
            'text' => trans('language.heading_title'),
            'href' => 'admin.languages'
        );


        Session::flash('breadcrumbs', $data);
        return view('admin.language_form')->with([ 'action'=>$action] );

    }

    public function store(Request $request)
    {
        $Destination = resource_path('lang/' . $request->get('code') .'/' );
        $Directory = resource_path('lang/templang' );
        if(!File::isDirectory($Destination)) {
            File::makeDirectory($Destination);
            File::copyDirectory($Directory, $Destination);
        }else{
            $warning= 'Warning: the language is found !!' ;
            Session::flash('warning' , $warning);
            return redirect()->back();
        }

        $code1=$request->get('code1');
        if($code1 != null) {
            foreach ($code1 as $key => $file) {
                $filePath = resource_path('lang/' . $request->get('code') . '/' . $key);
                if (File::exists($filePath))
                    $content = File::replace($filePath, $file);
            }
        }
        Language::create($request->except(['_token','store_id' , 'code1' ,'path']));

        $success= 'the language created successfully' ;
        Session::flash('success' , $success);
        return redirect()->route('admin.languages');
    }

    public function edit($code = 'en')
    {
        $action = url('admin/languages/update');

        $data['buttons'] = '  <button type="submit" form="form-language" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="' . trans('product.button_save') . '"><i class="fa fa-save"></i></button>
        <a href="../../languages" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="' . trans('product.button_cancel') . '"><i class="fa fa-reply"></i></a>
       ';
        $data['heading_title'] = ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . trans('language.heading_title_edit');
        $data['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> ' . trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        $data['breadcrumbs'][] = array(
            'text' => trans('language.heading_title'),
            'href' => 'admin.languages'
        );

        $language = Language::where('code', $code)->first();

        Session::flash('breadcrumbs', $data);
        return view('admin.language_form', $language)->with(['code'=> $code , 'action'=>$action] );

    }

    public function update(Request $request)
    {
        $filesContent=$request->get('code1');
       if($filesContent)
       {
           foreach ($filesContent as $key => $file)
           {
               $filePath = resource_path('lang/' . $request->get('code') . '/' . $key);
               if (File::exists($filePath))
                   File::replace($filePath, $file);
           }
       }
        Language::where('code' , $request->get('code'))
            ->update($request->except(['_token','store_id' , 'code1' ,'path']));

        $success= 'the language updated successfully' ;
        Session::flash('success' , $success);

        return redirect()->route('admin.languages');
    }

    public function path($code = 'ar')
    {

        $directory = resource_path('lang/' . $code . '/');

        $content = File::allFiles($directory);
        $files = [];

        foreach ($content as $file) {
            $files['file'][] = array(
                'name' => $file->getFilename(),
                'path' => $file->getBasename()
            );

        }
        return Response()->json($files);

    }

    public function getContent($directory, $filename)
    {
        $file= resource_path('lang/' . $directory . '/' . $filename);
        $content['code'] = File::get($file);

        return Response()->json($content);
    }

    public function save(Request $request, $code, $filename)
    {
        $file = resource_path('lang/' . $code . '/' . $filename);
        if(!File::isFile($file))
            return response()->json([ 'error' => "this not file !!"]);

        $content = File::replace($file, request('code'));
        $success= 'the file <a href="#" target="_blank" class="alert-link"> '. $filename .' </a> saved successfully..' ;

        return response()->json([ 'success' => $success]);


    }
    public function  Delete(Request $request)
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);


         if(array_diff($arrID ,['0'=>1]) !== [])
         {
             $codes = Language::find(array_diff($arrID ,['0'=>1]));
             foreach ($codes as $code) {
                 $directory = resource_path('lang/' . $code['code']);
                 if (File::isDirectory($directory) && $code['code'] !== 'en')
                     File::deleteDirectory($directory);
             }

             Language::destroy(array_diff($arrID ,['0'=>1]));

         }else{

             $warning= 'can not delete the English language  ..' ;
             Session::flash('warning' , $warning);
              return response()->json(['error' => 1, 'msg' =>$warning]);
         }

        }
        $success= 'the language/languages deleted successfully' ;
        Session::flash('success' , $success);
        return response()->json(['error' => 0, 'msg' => 'hhhhhhhhhhhhh']);


    }

}
