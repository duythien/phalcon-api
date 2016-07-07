<?php
/**
 * Debug.php
 * Debug
 *
 * Offers shortcuts to functions for easier debugging
 *
 * @author      Nikos Dimopoulos <nikos@niden.net>
 * @since       10/27/2012-12-03
 *
 */

if (!function_exists('vd')) {
    /**
     * var_dump()
     */
    function vd($string)
    {
        foxDebugPre();
        foxDebugCaller();
        var_dump($string);
        foxDebugPost();
    }
}

if (!function_exists('pr')) {
    /**
     * print_r($string)
     */
    function pr($string)
    {
        foxDebugPre();
        foxDebugCaller();
        print_r($string);
        foxDebugPost();
    }
}

if (!function_exists('vdd')) {
    /**
     * var_dump() + die()
     */
    function vdd($string)
    {
        foxDebugPre();
        foxDebugCaller();
        var_dump($string);
        foxDebugPost();
        exit();
    }
}

if (!function_exists('prd')) {
    /**
     * print_r($string) + die()
     */
    function prd($string)
    {
        foxDebugPre();
        foxDebugCaller();
        print_r($string);
        foxDebugPost();
        exit();
    }
}

if (!function_exists('gcm')) {
    /**
     * get_class_methods($class)
     */
    function gcm($class)
    {
        foxDebugPre();
        foxDebugCaller();
        return get_class_methods($class);
        foxDebugPost();
    }
}

if (!function_exists('e')) {
    /**
     * echo($string)
     */
    function e($string)
    {
        foxDebugPre();
        foxDebugCaller();
        print($string);
        foxDebugPost();
    }
}

if (!function_exists('d')) {
    /**
     * die($string)
     */
    function d($object, $kill = true)
    {
        foxDebugPre();
        foxDebugCaller();
        
        echo '<pre style="text-aling:left">', print_r($object, true), '</pre>';
        $kill && exit(1);
        
        foxDebugPost();
    }
}

if (!function_exists('foxDebugPre')) {
    function foxDebugPre()
    {
        echo (foxDebugCli()) ? ' ' : "<pre style='overflow: auto;' class='code-dump'>";
    }
}

if (!function_exists('foxDebugPost')) {
    function foxDebugPost()
    {
        echo (foxDebugCli()) ? ' ' : "</pre>";
    }
}

if (!function_exists('foxDebugCli')) {
    function foxDebugCli()
    {
        return (empty($_SERVER['REQUEST_METHOD'])) ? true : false;
    }
}

if (!function_exists('foxDebugCaller')) {
    function foxDebugCaller()
    {
        $trace = debug_backtrace();

        echo sprintf(
            'Called From: %s:%d %s',
            $trace[1]['file'],
            $trace[1]['line'],
            PHP_EOL
        );
    }
}
