<?php
/**
 * class used for testing codeigniter code
 * @author andy
 *
 */
class Test extends  CI_Controller
{
    
    public function  __construct()
    {
        parent::__construct();
        
//         $this->output->enable_profiler(true);
        $this->load->helper('string');
    }
    
    public function  index()
    {
        
//         $enconding = ini_get('mbstring.encoding.parameter');
//         var_dump($enconding);
        echo substring('两次买米。。。。一次买鸡蛋。。。。', 1);
    }
    
}