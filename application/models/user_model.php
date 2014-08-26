<?php
/**
 * class is used to create user's model
 * @author andy
 *
 */
class User_model extends CI_Model
{
    /**
     * 
     * @var string $username -- user's name
     * @var string $password -- user's password
     */
   private $username;
   private $password;
   
   public  function __construct()
   {
       parent::__construct();
   }
   
   /**
    * save user's data into database
    * @param string $username -- user's name
    * @param string $password -- user's password
    * @access public
    * @return booolean -- register successfully or failure
    */
   public function insert($username, $password){
      $data = $this->get_user_data($username, $password);
      if (!$this->username_is_exist($username)) {
          return $this->db->insert('user', $data);
      }
       return false;
   }
   
   /**
    * method used to login in 
    * @param stirng $username
    * @param string $password
    * @access public
    * @return boolean -- login in successfully or failure
    */
   public function login($username, $password){
       $data  = $this->get_user_data($username, $password);
       $query = $this->db->get_where('user', $data);
       $result = $query->row(); 
       if ($result) {
           return $result->id;
       }
       return  false;
   }
   
   /**
    * using md5 encypts user's password
    * @param string $password
    * @access private
    * @return string
    */
   private function encyptyPassword($password)
   {
       return md5('cvg_' . $password);
   }
   
   /**
    * whether to jude user's username is exist or not
    * @param string $username
    * @access public
    * @return boolean
    */
   public function  username_is_exist($username)
   {
       $query = $this->db->get_where('user', array('username'=>$username));
       if ($query->num_rows() >0) {
           return true;
       }
       return  false;
   }
   
   /**
    * update user's password
    * @param string $password
    * @return boolean
    */
   public  function  updatePassword($username, $password, $old_password)
   {
       // query the user's password is right or not
       $query = $this->db->get_where('user', array('username'=>$username, 'password'=>$this->encyptyPassword($old_password)), 1);
       if ($query->result())// update user's password 
       { 
           $this->db->where('username', $username);
           $count = $this->db->update('user', array('password'=>$this->encyptyPassword($password)));
           if($count > 0)
           {
               return true;
           }
       }
       return false;
   }
   
   /**
    * get array of user for insert values into database
    * @param string $username
    * @param string $password
    * @access private
    * @return array string -- array of user
    */
   private function  get_user_data($username, $password)
   {
       $user = array('username'=>$username,
                     'password'=>$this->encyptyPassword($password)
                    );
       return $user;
   }
   
   public function add_or_sub_count($flag = 1)
   {
       $user_id = $this->session->userdata("user_id");
       $count   = $this->get_user_count();
       $count   = $flag ? ++$count : --$count;
       $this->db->where("id", $user_id);
       $this->db->update("user", array("count"=>$count));
       
       return $count;
   }
   
   public function  get_user_count()
   {
       $user_id = $this->session->userdata("user_id");
       $query   = $this->db->get_where("user", array("id"=>$user_id));
       $count   = 0; // initial value is zero
       if($query->num_rows() > 0)
       {
           $count = $query->row()->count;
       }
       return $count;
   }
   
   public function get_total_count()
   {
       $this->db->select("sum(count) total_count");
       $this->db->from("user");
       return $this->db->get()->row();
   }
   
   public function  get_all_user_count()
   {
       $this->db->select("id, username, sum(count) as count");
       $this->db->from("user");
       $this->db->group_by("id");
       return $this->db->get()->result();
   }
}