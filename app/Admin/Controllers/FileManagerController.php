<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FileManagerController extends Controller
{

    public function index()
    {


    }

    public function test()
    {

return view('admin.file_manager');
    }



    public function filemanager( $directory= null )
    {
        $filter_name= null;
        if ($filter_name!== null) {
            $filter_name = rtrim(str_replace(array('../', '..\\', '..', '*'), '', $filter_name), '/');
        } else {
            $filter_name = null;
        }

        $data['filter_name']=$filter_name;
        $directory1=str_replace('-' ,'/', $directory);

        if ( $directory!== null && $directory!== 'undefined') {
            $directory = rtrim(public_path().'/view/image/catalog/' . str_replace('-', '/', $directory), '/');

        } else {
            $directory = public_path().'/view/image/catalog';
        }

        $data['images'] = array();
        $directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

        if (!$directories) {
            $directories = array();
        }

        $files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

        if (!$files) {
            $files = array();
        }
        // Merge directories and files
        $images = array_merge($directories, $files);
        $image_total = count($images);
        $page=1;
       // $images = array_splice($images, ($page - 1) * 16, 16);

        foreach ($images as $image) {
            $name = str_split(basename($image), 14);

            if (is_dir($image))
            {
                $data['images'][] = array(
                    'thumb' => '',
                    'name'  => implode(' ', $name),
                    'type'  => 'directory',
                    'path'  => substr($image, strlen(public_path().'/view/image/')),
                    'src'  => '../../uploads/filemanager/'.str_replace('/' ,'-',substr($image, strlen(public_path().'/view/image/catalog/')))
                );
            }
            elseif (is_file($image))
            {
                $data['images'][] = array(
                    'thumb' => asset('/view/image/catalog').'/' .substr($image, strlen(public_path().'/view/image/catalog/')),
                    'name'  => implode(' ', $name),
                    'type'  => 'image',
                    'path'  => substr($image, strlen(public_path().'/view/image/')),
                    'src'  =>  asset('/view/image/catalog').'/' .substr($image, strlen(public_path().'/view/image/catalog/'))
                );

            }

        }

        if ($directory1!== null && $directory1!== 'undefined')
        {
            $data['directory'] = urlencode($directory1);
        }
        else {
            $data['directory'] = '';
        }
        $data['dir']=str_replace('/' ,'-',$directory1) ;
        // Parent
        $url = '';
        if ($directory1!== null && $directory1!== 'undefined')
        {
            $pos = strrpos($directory1, '/');

            if ($pos)
            {
                $url =  urlencode(substr(str_replace('/' ,'-',$directory1), 0, $pos));
            }
            else { $url =  'undefined' ;}
        }
        else { $url =  'undefined' ;}

        $data['parent'] = '../../uploads/filemanager/'. $url ;
        // Refresh
        $url = '';

        if ($directory1!== null && $directory1!== 'undefined')
        {
            $url =  urlencode( str_replace('/' ,'-', $directory1));
        }
        else { $url =  'undefined' ;}

        $data['refresh'] = '../../uploads/filemanager/'. $url ;
        $data['heading_title']  = 'Image Manager';
        $data['entry_search']   = 'Search..';
        $data['button_folder']  = 'New Folder';
        $data['button_search']  = 'Search';
        $data['button_upload']  = 'Upload';
        $data['button_delete']  = 'Delete';
        $data['text_confirm']   = 'Are you sure?';

        return view('admin.filemanager')->with(['data' => $data]);

    }


    public function create_folder(Request $request)
    {

        $json = array();

        // Check user has permission
        /*    if (!$this->user->hasPermission('modify', 'common/filemanager')) {
              $json['error'] = $this->language->get('error_permission');
            }
        */
        // Make sure we have the correct directory
        if ($request->input('directory'))
        {
            $directory = rtrim(public_path().'/view/image/catalog/' . str_replace(array('../', '..\\', '..'), '', urldecode($request->input('directory')) ), '/');
        }
        else
        {
            $directory = public_path().'/view/image/catalog';
        }
        // Check its a directory
        if (!is_dir($directory))
        {
            $json['error'] = 'error_directory';
        }

        if (!$json) {
            // Sanitize the folder name
            $folder = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($request->get('folder'), ENT_QUOTES, 'UTF-8')));

            // Validate the filename length
            if ((strlen($folder) < 3) || (strlen($folder) > 128)) {
                $json['error'] =  'the charecters of folder is les than 3 !!!' ;
            }

            // Check if directory already exists or not
            if (is_dir($directory . '/' . $folder))
            {
                $json['error'] =  'error_exists' ;
            }

            mkdir($directory . '/' . $folder, 0777);
            $json['success'] =  'the folder created successfuly...';
        }
        return  Response()->json($json);
    }


    public function delete_folder(Request $request)
    {
        $json = array();

        if ($request->post('path'))
        {  $paths = $request->post('path');  }
        else { $paths = array();  }

        if (!$json)
        {  // !$json   if a json array is impty
            // Loop through each path
            foreach ($paths as $path)
            {
                $path = rtrim(public_path().'/view/image/'  . str_replace(array('../', '..\\', '..'), '', $path), '/');

                // If path is just a file delete it
                if (is_file($path))
                {
                    unlink($path);
                    // If path is a directory beging deleting each file and sub folder
                }
                elseif (is_dir($path))
                {
                    $files = array();

                    // Make path into an array
                    $path = array($path . '*');

                    // While the path array is still populated keep looping through
                    while (count($path) != 0) {
                        $next = array_shift($path);

                        foreach (glob($next) as $file) {
                            // If directory add to path array
                            if (is_dir($file)) {
                                $path[] = $file . '/*';
                            }

                            // Add the file to the files to be deleted array
                            $files[] = $file;
                        }
                    }

                    // Reverse sort the file array
                    rsort($files);

                    foreach ($files as $file) {
                        // If file just delete
                        if (is_file($file)) {
                            unlink($file);

                            // If directory use the remove directory function
                        } elseif (is_dir($file)) {
                            rmdir($file);
                        }
                    }
                }
            }

            $json['success'] = 'success_delete';
        }

        return  Response()->json($json);
    }


    public function upload_file(Request $request , $directory)
    {
        $input=$request->all();
        $file= $input['file'];
        $ex=$file->getClientOriginalExtension();
        $filename=rand(11111 , 99999).'.'.$ex ;

        if ($directory !== 'undefined')
        {
            $directory = rtrim(public_path().'/view/image/catalog/'  . str_replace('-', '/',  $directory), '/');
        }
        else {
            $directory =public_path().'/view/image/catalog' ;
        }
        // Allowed file mime types
        $allowed = array('jpg','pjpeg','ipng','png','gif' );
        $json = array();
        if (!in_array($ex, $allowed))
        {
            $json['error'] =  'the file type ' . '(' .$ex . ')' . ' not allowed';
        }
        else {
            $upload_success=$file->move(  $directory ,  $filename ) ;
            $json['success'] = 'the image uploaded successfuly...';
        }
        return  Response()->json($json);

    }

}
