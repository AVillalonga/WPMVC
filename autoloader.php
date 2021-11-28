<?php

/**
 * @package WPMVC
 */

namespace WPMVC;

if (!function_exists('wpmvc_autoload')) {
    function wpmvc_autoload($resource = '')
    {
        if(empty($resource)) return;
        
        $remove_limit_antislashs    = fn($resource): string => trim($resource, '\\');
        $got_namespace              = fn($namespace, $resource): string => strpos($resource, WPB_NAMESPACE) === 0;
        $remove_namespace           = fn($namespace, $resource): string => preg_replace('/'.preg_quote($namespace, '/').'/', '', $resource, 1);
        
        $resource = $remove_limit_antislashs($resource);
        if($got_namespace(WPMVC_THEME_NAMESPACE, $resource)) {
            $resource = $remove_namespace(WPMVC_THEME_NAMESPACE, $resource);
            $resource = str_replace('\\', '/', $resource);
            $resource = str_replace('_', '-', $resource);
            $resource = strtolower($resource);
            $resource = WPMVC_THEME_DIRECTORY .  '/' . $resource . '.php';
            if(is_file($resource)) require_once $resource;
        }
    }
}

spl_autoload_register('\WPMVC\wpmvc_autoload');