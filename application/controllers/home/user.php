<?php

/**
 * class is used to display user's information
 * @author andy
 *
 */
class User extends CI_Controller
{
    private $_user;
    private $_record;
    
    public function __construct()
    {
        parent::__construct();
        
        // load helpers 
        $this->load->helper('string');
        
        // load models
        $this->_user   = getModel('user');;
        $this->_record = getModel('record');
    }
    
    /**
     * user logout
     */
    public function  logout()
    {
       sessionDestroy();
       redirect('/authentication/login');
    }
    
    /**
     * get user's information
     * @param string $username -- user's name
     */
    public function  info($username)
    {
        $session_username  = getSession('username');
        if ($username !== $session_username)
        {
            redirect('/login');
        }
        renderHomeContent('home/user_center.phtml', ["active" => 3]);
    }
    
    /**
     * add a record of the current logined user
     */  
    public function add_record()
    {
        $money    = getPostParameter('money');
        $desc     = getPostParameter('desc');
        $user_id  = $this->getCurrentUserId();
        $log_time = date('Y-m-d H:i:s');
        
        $count = $this->_record->add_record(array('user_id'=>$user_id, 'money'=>$money, 'desc'=>$desc, 'log_time'=>$log_time));
        if($count){
            $this->writeJson(array('status'=>true, 'message'=>'添加记录成功！'));
        }else {
            $this->writeJson(array('status'=>false, 'message'=>'添加记录失败！'));
        }
    }
    
    /**
     * update the curent logined user's password
     */
    public function update_password()
    {
        $password     = getPostParameter('password');
        $old_password = getPostParameter('old_password');
        $username     = getSession('username');
        
        if ($this->_user->updatePassword($username, $password, $old_password)){
            $this->writeJson(array('status'=>true, 'message'=>'密码修改成功！'));
        }else{
            $this->writeJson(array('status'=>false, 'message'=>'旧密码不正确！'));
        }
    }
    
    /**
     * get the current user's all of record
     */
    public function  get_all_records()
    {
        $data['records'] = $this->_record->get_all_records();
        $data['active']    = 1;
        
        renderHomeContent('home/record.phtml', $data);
    }
    
    /**
     *  count++ or count--
     * @param number $flag -- add or sub
     */
    public function  add_or_sub_count($flag = 1)
    {
        $count = $this->get_user_count();
        if($flag || (!$flag && $count > 0)){
            $count = $this->_user->add_or_sub_count($flag);
            $user_id  = $this->getCurrentUserId();
            $last_record_log_time = $this->_user->updateRecordLogDate($user_id);
        }
        $this->writeJson(array("status"=>true, "count"=>$count, 'log_time' => $last_record_log_time));
    }
    
    
    /**
     * get user's total count
     * @return integer $count -- user's count
     */
    public function  get_user_count()
    {
        return $this->_user->get_user_count();
    }
    
    /**
     * delete a record from the current logined user
     * @param integer $record_id -- the deleted record's id
     */
    public function delete_record($record_id)
    {
       if ($this->_record->delete_record($record_id))
       {
           $this->writeJson(array("status"=>true));
       }else 
       {
           $this->writeJson(array("status"=>false));
       }
    }
    
    /**
     * method is used to display the result for all the user
     */
    public function  result()
    {
        $data['user_result']  = $this->_record->get_all_user_total(); // user's result 
        $data['total']        = $this->_record->get_total()->total; // the total of money
        $total_count          = $this->_user->get_total_count()->total_count; // the number of eating
        $users                = $this->_user->get_all_user_count();  // get the variable count of all the user
        $data['spend_result'] = array(); // the result of spend moeny 
        $data['final_result'] = array();
        if ($total_count) {
            foreach ($users as $user)
            {
                $username               = $user->username;
                $user_count             = $user->count ? $user->count : 0;
                $user_progress          = $user_count / $total_count;
                
                $user_total_spend       = round($user_progress * $data['total'], 2);
                $data['spend_result'][] = array('username'      => $username, 
                                                'user_spend'    => $user_total_spend,
                                                'user_count'    => $user_count, 
                                                'user_progress' => round($user_progress * 100, 2)
                                          );
                
                $user_total_money       = $this->_record->get_user_total($user->id)->total;
                $result_total           = $user_total_money - $user_total_spend;
                $data['final_result'][] = array('username'=>$username, 'result_total' =>$result_total);
            }
        }
        
        $data['active']    = 2;
        renderHomeContent('home/bills.phtml', $data);
    }
}