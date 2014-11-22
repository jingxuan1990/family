<?php
/**
 * class used to register
 * @author Andy
 *
 */
class Registration extends CI_Controller
{
//     protected  $model = 'user';
    
    public  function __construct()
    {
        parent::__construct();
    }
    
    /**
     * show the registration page for a user
     * @access public 
     * 
     */
    public function index()
    {
       $data['title']    = 'registration';
       
       $this->load->view('templates/header.phtml', $data);
       $this->load->view('authentication/registration.phtml');
       $this->load->view('templates/footer.phtml');
    }
   
    /**
     * method is used to add a new user
     */
    public  function  register()
    {
        $json_data = array();
        $username = getPostParameter('username');
        $password = getPostParameter('password');
      
        if (getModel('user')->insert($username, $password)){
            $json_data = array('status'=> true, 'message' =>'用户注册成功！');
        } else {
            $json_data = array('status'=> false, 'message' =>'该用户名已经存在！');
        }
      
        $this->writeJson($json_data);
        
    }
    
}