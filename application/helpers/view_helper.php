<?php

function render($ci, $title, $panel_path = '', $data = array()) {
    
    $username = $ci->session->userdata ( 'username' );
    $user_id  = $ci->session->userdata('user_id');
    
    if (empty ( $username )) {
        redirect ( 'authentication/login' );
    } else {
        $data_title ['title'] = $title;
        $data ['username']    = $username;
        $panel['panel']       = $ci->load->view ( $panel_path, $data, true );
        $panel['count']       = $ci->user->get_user_count();
        $content ['content']  = $ci->load->view ( 'home/main.phtml', $panel, true );
        $last_record_log_time = $ci->user->getRecordLogDate($user_id);
        $content ['log_time'] = date('Y年m月d日  H:i', strtotime($last_record_log_time));
        
        $ci->load->view ( 'templates/header.phtml', $data_title );
        $ci->load->view ( 'index.phtml', $content );
        $ci->load->view ( 'templates/footer.phtml' );
    }
}