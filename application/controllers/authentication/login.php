<?php
/**
 * class used to login in
 * @author Andy
 *
 */
class Login extends CI_Controller
{
//     protected  $model = 'user';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function  index()
    {
        $data['title']    = 'login';
        
        $this->load->view('templates/header.phtml', $data);
        $this->load->view('authentication/login.phtml');
        $this->load->view('templates/footer.phtml');
    }
    
    public function user_login()
    {
        $username = getPostParameter('username');
        $password = getPostParameter('password');
        $json_data= array();
        $user = getModel('user')->login($username, $password);  
        if ($user)
        {
            setSessions(['username' => $username, 'user_id' => $user->id]);
            $json_data = array('status'=>true, 'message'=>'用户登录成功!');
        }else{
            $json_data = array('status'=>false, 'message'=>'用户名或密码错误！');
        }
        $this->writeJson($json_data);
    }
    
}