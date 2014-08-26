<?php
/**
 * class is used to create user's model
 * @author andy
 *
 */
class Record_model extends CI_Model
{
    /**
     * 
     * @var integer $id -- record's id
     * @var integer $user_id -- record's user_id
     * @var string $desc -- record's desc
     * @var decimal $money -- how much
     * @var date $log_time -- the date of a record 
     */
   private $id;
   private $user_id;
   private $desc;
   private $money;
   private $log_time;
   
   public  function __construct()
   {
       parent::__construct();
   }
   
   public function add_record($array = array()){
       
       if ($this->db->insert("record", $array)) {
           return true;
       }
       return false;
   }
   
   public function  get_all_records()
   {
      $this->db->select("record.id as record_id, username, record.desc as des, record.log_time as log_time, money");
      $this->db->from("record");
      $this->db->join("user", "user.id = record.user_id");
      $this->db->order_by("record.log_time desc");
      return $this->db->get()->result();
   }
   
   public function  delete_record($record_id)
   {
       return $this->db->delete("record", array("id"=>$record_id));
   }
   
   public function get_all_user_total()
   {
       $this->db->select("username, sum(record.money) total");
       $this->db->from("record");
       $this->db->join("user", "user.id = record.user_id");
       $this->db->group_by("user_id");
       return $this->db->get()->result();
   }
   
   public function get_user_total($user_id)
   {
       $this->db->select("sum(record.money) total");
       $this->db->from("record");
       $this->db->where(array("user_id"=>$user_id));
       return $this->db->get()->row();
   }
   
   public function get_total()
   {
       $this->db->select("sum(record.money) total");
       $this->db->from("record");
       return $this->db->get()->row();
   }

}