<?php
/**
 * class used to create user model
 * @author andy
 *
 */
class Record_model extends CI_Model
{
    /**
     * 
     * @var integer
     */
   private $id;
   
   /**
    * 
    * @var integer
    */
   private $user_id;
   
   /**
    * 
    * @var string -- record's describle
    */
   private $desc;
   
   /**
    * 
    * @var float -- record's money
    */
   private $money;
   
   /**
    * 
    * @var string -- the log time of record
    */
   private $log_time;
   
   public  function __construct()
   {
       parent::__construct();
   }
   
   /**
    * method used to 
    * 
    * @param array $array -- resprent a record object
    * @return boolean -- if the record is added successfully
    */
   public function add_record($array = array())
   {
       
       if ($this->db->insert("record", $array)) {
           
           return true;
       }
       
       return false;
   }
   
   /**
    * method used to select all records from record table
    * 
    * @return 
    */
   public function  get_all_records()
   {
      $this->db->select("record.id as record_id, username, record.desc as des, record.log_time as log_time, money");
      $this->db->from("record");
      $this->db->join("user", "user.id = record.user_id");
      $this->db->order_by("record.log_time desc");
      
      return $this->db->get()->result();
   }
   
   /**
    * method used to delete a record from table according to the $record_id param
    * 
    * @param integer $record_id
    * @return boolean -- returns true on success, returns false on faliure   
    */
   public function  delete_record($record_id)
   {
       return $this->db->delete("record", array("id"=>$record_id));
   }
   
   /**
    * method used to get the total money of each user on theirself records
    *  
    */
   public function get_all_user_total()
   {
       $this->db->select("username, sum(record.money) total");
       $this->db->from("record");
       $this->db->join("user", "user.id = record.user_id");
       $this->db->group_by("user_id");
       
       return $this->db->get()->result();
   }
   
   /**
    * method used to get the total money of the current logged in user
    * 
    * @param integer $user_id
    */
   public function get_user_total($user_id)
   {
       $this->db->select("sum(record.money) total");
       $this->db->from("record");
       $this->db->where(array("user_id"=>$user_id));
       
       return $this->db->get()->row();
   }
   
   /**
    * method used to get the total money of all record
    */
   public function get_total()
   {
       $this->db->select("sum(record.money) total");
       $this->db->from("record");
       
       return $this->db->get()->row();
   }

}