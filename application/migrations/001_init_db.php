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
            ) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
       " );
        
        $this->db->query ( "
            CREATE TABLE `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(50) NOT NULL,
              `password` varchar(50) NOT NULL,
              `identity` tinyint(4) NOT NULL DEFAULT '0',
              `log_time` datetime DEFAULT NULL,
              `count` int(11) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`),
              UNIQUE KEY `username_UNIQUE` (`username`)
            ) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
       " );
    }
    
    public function down() 
    {
        $this->db->query ( "DROP TABLE IF EXISTS `record`" );
        $this->db->query ( "DROP TABLE IF EXISTS `user`;" );
    }
}
