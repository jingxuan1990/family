<?php
/**
 * class is used to display Home page
 * @author andy
 *
 */
class Index extends  CI_Controller
{
    
    public function  __construct()
    {
        parent::__construct();
    }
    
    public function  index()
    {
        $data['records']   = getModel('record')->get_all_records();
        $data['active']    = 1;
        renderHomeContent('home/record.phtml', $data);
    }
    
}