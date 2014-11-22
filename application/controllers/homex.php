<?php
/**
 * class is used to display Home page
 * @author andy
 *
 */
class Homex extends  CI_Controller
{
    
    public function  __construct()
    {
        parent::__construct();
//         $this->output->enable_profiler(true);
    }
    
    public function  index()
    {
        $data['records'] = getModel('record')->get_all_records();
        $data['active']    = 1;
        
        renderHomeContent('home/record.phtml', $data);
    }
    
}