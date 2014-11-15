<?php

/**
 * get a variable's value from the application's session
 * 
 * @param string $param -- get the value from session
 * @return boolean -- if can get value from sessiom returns the value, othewise returns false
 */

function getSession($param = false)
{
    $ci = &get_instance();
    if ($param){
        return $ci->session->userdata($param);
    }
    return false;
}

/**
 * set value for a variable in the session
 * 
 * @param string $param -- the key of session
 * @param string $value -- the value of session
 */
function setSession($param, $value = '')
{
    $ci = &get_instance();
    $ci->session->set_userdata($param, $value);
}

/**
 * set a number of sessions once
 * @param array $array -- associeted array
 */
function setSessions(array $array = array())
{
    foreach ($array as $key => $value)
    {
        setSession($key, $value);
    }
}

/**
 * destory the system's session
 */
function  sessionDestroy()
{
    $ci = & get_instance();
    $ci->session->sess_destroy();
}