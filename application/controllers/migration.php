<?php
/**
 * 
 * @author andy
 *
 */

class Migration extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("migration");
    }
   
    public function migrate($username, $password, $version = 0)
    {
        if ('admin' === $username && 'admin' === $password) {
            $db_name = $this->db->database;
            
            if (!$this->migration->version($version)) {
                echo 'Have deleted all schemas from '.$db_name;
            } else {
                echo 'Migrate database successfully for '.$db_name;
            }
        }
    }
    
}