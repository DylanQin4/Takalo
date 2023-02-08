<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('generate_url'))
{
    function generate_url($controller, $method, $params = array())
    {
        $CI =& get_instance();
        return $CI->config->site_url($controller.'/'.$method.'/'.implode('/', $params));
    }
}
