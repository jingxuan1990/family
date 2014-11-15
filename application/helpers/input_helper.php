<?php

/**
 * file used to get parameters from input
 * @author Andy
 */

function getGetParameter($param)
{
    $ci = &get_instance();
    return $ci->input->get($param, TRUE);
}

function getGetParameters()
{
    $ci = &get_instance();
    return $ci->input->get(NULL, TRUE);
}


function getPostParameter($param)
{
    $ci  = &get_instance();
    return $ci->input->post($param, TRUE);
}

function getPostParameters()
{
    $ci  = &get_instance();
    return $ci->input->post(NULL, TRUE);
}


function getServerParameter($param)
{
    $ci = &get_instance();
    return $ci->input->server($param, TRUE);
}


function getParameter($param)
{
    $ci = &get_instance();
    return $ci->input->get_post($param, TRUE);
}

function getParameters()
{
    $ci = &get_instance();
    $getData= getGetParameters() ? getGetParameters() : array();
    $postData = getPostParameters() ? getPostParameters() : array();
    
    return array_merge($getData, $postData);
}