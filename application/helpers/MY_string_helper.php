<?php
/**
 * 
 * file extends string helper
 * 
 * @author andy
 */
 
if (!function_exists('substring')) {
    
    function substring($input, $length = false) {
        if ($length === false) {
            $length = strlen($input);
        }
        
        return mb_substr($input, 0, $length, 'utf-8');
    }
}