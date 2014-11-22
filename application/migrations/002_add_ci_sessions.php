<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Migration_Add_ci_sessions extends CI_Migration {
    
    public function up() 
    {
//         $this->db->query ( "
//                  CREATE TABLE `ci_sessions` (
//                   `session_id` varchar(40) NOT NULL DEFAULT '0',
//                   `ip_address` varchar(45) NOT NULL DEFAULT '0',
//                   `user_agent` varchar(120) NOT NULL,
//                   `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
//                   `user_data` text NOT NULL,
//                   PRIMARY KEY (`session_id`),
//                   KEY `last_activity_idx` (`last_activity`)
//                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
//            " );
    }
    
    public function down() 
    {
//         $this->db->query ( "DROP TABLE IF EXISTS `ci_sessions`" );
    }
}
