<?php

/**
 * 
 * @param string $panel_path -- the rendered file path
 * @param array $data -- data for rendering page
 */
function renderHomeContent($file_path = '', array $data = array()) {
    $ci = & get_instance(); // codeinniter object
    
    $username = getSession('username');
    $user_id  = getSession('user_id');
    
    if (!$username) { // if the username is not valid, redirect to the login page
        redirect ( 'authentication/login' );
    } else {
        $data_title ['title'] = 'Home';
        $data ['username']    = $username;
        $panel['panel']       = $ci->load->view ( $file_path, $data, true );
        $panel['count']       = $ci->user->get_user_count();
        $content ['content']  = $ci->load->view ( 'home/main.phtml', $panel, true );
        $last_record_log_time = $ci->user->getRecordLogDate($user_id);
        $content ['log_time'] = unix_to_human(strtotime($last_record_log_time));
        $ci->load->view ( 'templates/header.phtml', $data_title );
        $ci->load->view ( 'index.phtml', $content );
        $ci->load->view ( 'templates/footer.phtml' );
    }
}