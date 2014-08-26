<?php

function render($ci, $title, $panel_path = '', $data = array()) {
    
    $username = $ci->session->userdata ( 'username' );
    if (empty ( $username )) {
        redirect ( 'login' );
    } else {
        $data_title ['title'] = $title;
        $data ['username']    = $username;
        $panel['panel']       = $ci->load->view ( $panel_path, $data, true );
        $panel['count']       = $ci->user->get_user_count();
        $content ['content']  = $ci->load->view ( 'main.phtml', $panel, true );
        
        $ci->load->view ( 'templates/header.phtml', $data_title );
        $ci->load->view ( 'home.phtml', $content );
        $ci->load->view ( 'templates/footer.phtml' );
    }
}