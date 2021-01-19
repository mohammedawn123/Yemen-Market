<?php
$router->group(['prefix' => 'uploads'], function ($router) {

    $router->get('filemanager/{directory}', 'FileManagerController@filemanager');
    $router->get('Edit_category/filemanager/{directory}', 'FileManagerController@filemanager');
    $router->post('filemanager/folder', 'FileManagerController@create_folder');
    $router->post('filemanager/delete_folder', 'FileManagerController@delete_folder');
    $router->post('filemanager/upload_file/{directory}', 'FileManagerController@upload_file');
    $router->get('file_manager', 'FileManagerController@test')->name('admin.file_manager');

});
