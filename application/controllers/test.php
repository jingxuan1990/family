<?php
/**
 * class is used to display Home page
 * @author andy
 *
 */
class Test extends  CI_Controller
{
    
    public function  __construct()
    {
        parent::__construct();
    }
    
    public function  index()
    {
//        $soure_dir = APPPATH . '/models';
//        var_dump($this->getFileNames($soure_dir));
//          var_dump(DIRECTORY_SEPARATOR);
var_dump(getModel('second'));
    }
    
    public function  getFileNames($soure_dir)
    {
        $_source_dir = APPPATH . '/models';
        static $_filedata = array();
        
        $current_dir = rtrim($soure_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        if ($files = scandir( $current_dir )) {
            foreach ($files as $file){
                if (strncmp($file, '.', 1) !==0 && strncmp($file, '..', 2) !==0){
                    if (is_dir($current_dir . $file)) {
//                         var_dump($file);
                        $this->getFileNames($current_dir . $file . DIRECTORY_SEPARATOR);
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
    
}