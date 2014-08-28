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
       $username = '我是中国人';
       $username2 = '12345';
       var_dump(strlen($username));
       var_dump(strlen($username2));
    }
    
}