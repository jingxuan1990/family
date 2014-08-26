<?php
/**
 * used to help user register
 * @author andy
 *
 */
class Registration extends CI_Controller
{
    
    public  function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); // load url helper class
        $this->load->model('User_model', 'user'); // load user's model class
    }
    
    /**
     * show the registration page for user
     * @access public 
     * @return NULL
     * 
     */
    public function index()
    {
       $data['title']    = 'registration';
       
       $this->load->view('templates/header.phtml', $data);
       $this->load->view('registration.phtml');
       $this->load->view('templates/footer.phtml');
    }
    
    /**
     * method used to add a new user
     */
    public  function  register()
    {
      $username = $this->input->post('username', TRUE);
      $password = $this->input->post('password', TRUE);
      
      if ($this->user->insert($username, $password))
      {
          $this->writeJson(array('status'=>true, 'message' =>'用户注册成功！'));
      }else{
          $this->writeJson(array('status'=>false, 'message' =>'该用户名已经存在！'));
      }
      
    }
    
}