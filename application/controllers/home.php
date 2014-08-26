<?php
/**
 * class is used to display Home page
 * @author andy
 *
 */
class Home extends  CI_Controller
{
    
    public function  __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'view')); 
        $this->load->model("Record_model", "record");
        $this->load->model("User_model", "user");
    }
    
    public function  index()
    {
        $data['records']   = $this->record->get_all_records();
        $data['active']    = 1;
        render($this, 'Home', 'content/record.phtml', $data);
    }
    
}