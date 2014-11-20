<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Migration_Init_db extends CI_Migration 
{
    public function up() 
    {
        $this->db->query ( "
             CREATE TABLE `record` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `desc` varchar(255) DEFAULT NULL,
              `user_id` int(11) NOT NULL,
              `log_time` varchar(45) NOT NULL,
              `money` decimal(11,2) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
       " );
        
        $this->db->query ( "
            CREATE TABLE `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(50) CHARACTER SET utf8 NOT NULL,
              `password` varchar(50) CHARACTER SET utf8 NOT NULL,
              `identity` bit(1) NOT NULL,
              `log_time` datetime NOT NULL,
              `count` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
       " );
    }
    
    public function down() 
    {
        $this->db->query ( "DROP TABLE IF EXISTS `record`" );
        $this->db->query ( "DROP TABLE IF EXISTS `user`;" );
    }
}
