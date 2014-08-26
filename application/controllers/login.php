<?php
/**
 * class is used to login in
 * @author andy
 *
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // load useful classes
        $this->load->model('User_model', 'user');
        $this->load->helper('url');
    }
    
    public function  index()
    {
        $data['title']    = 'login';
        
        $this->load->view('templates/header.phtml', $data);
        $this->load->view('login.phtml');
        $this->load->view('templates/footer.phtml');
    }
    
    public function user_login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        if (($user_id = $this->user->login($username, $password)))
        {
          /**
           * ============================
           * set session for logined user
           * ============================
           */
           $this->session->set_userdata('username' , $username);
           $this->session->set_userdata('user_id' , $user_id);
           $this->writeJson(array('status'=>true, 'message'=>'用户登录成功!'));
        }else{
           $this->writeJson(array('status'=>false, 'message'=>'用户名或密码错误！'));
        }
    }
    
}