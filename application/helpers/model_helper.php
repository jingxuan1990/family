<?php

/**
 * autoload models, and make an alias name for each model according to its name(e.g. User_model -> user)
 * 
 */
function autoloadModels() {
    $ci = &get_instance ();
    
    if (! function_exists ( 'get_filenames' )) {
        $ci->load->helper ( 'file' );
    }
    
    $files = _getFileNames ( APPPATH . '/models' );
    $filenames = array ();
    foreach ( $files as $file ) {
        $file_array = explode ( '.', $file );
        $file = $file_array [0];
        $file_extenstion = $file_array [1];
        if ($file_extenstion === 'php') {
            $position = strrpos($file, DIRECTORY_SEPARATOR);
            if ($position) {
                $filename = substr($file, $position+1);
                $filepath = substr($file, 0, $position+1);
                $alias_name = explode('_', $filename)[0];
                $filenames [$alias_name] = $filepath . ucfirst($filename);
            }else {
                $alias_name = explode('_', $file)[0];
                $filenames[$alias_name] = ucfirst($file);
            }
        }
    }
//     var_dump($filenames);
    
    foreach ( $filenames as $key => $value ) {
        $model_name = ucfirst($key . '_model');
        if (isset ( $ci->$key)){
            unset ( $ci->$key );
        }
        
        if (isset ( $ci->$model_name)){
            unset ( $ci->$model_name );
        }
        $new_value = str_replace('\\', '/', $value);
        $ci->load->model ( $new_value, $key );
    }
}

function  _getFileNames($soure_dir)
{
    $_source_dir = APPPATH . '/models';
    static $_filedata = array();

    $current_dir = rtrim($soure_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    if ($files = scandir( $current_dir )) {
        foreach ($files as $file){
            if (strncmp($file, '.', 1) !==0 && strncmp($file, '..', 2) !==0){
                if (is_dir($current_dir . $file)) {
                    //                         var_dump($file);
                    _getFileNames($current_dir . $file . DIRECTORY_SEPARATOR);
                }else{
                    //                         var_dump($current_dir);
                    $_filedata[] = ltrim(ltrim($current_dir, $_source_dir), DIRECTORY_SEPARATOR) . $file;
                }
            }
        }
        return  $_filedata;
    }else {
        return false;
    }

}

/**
 * returns the model object according to a variable model_name
 * 
 * @param string $model_name -- a model's alias name
 * @return boolean | string -- if the model exists, return this object; otherwise, otherwise returns false.
 */
function getModel($model_name)
{
    $ci = &get_instance();
    if (isset($ci->$model_name)) {
        return $ci->$model_name;
    }
    
    return false;
}
