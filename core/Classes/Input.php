<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Classes;
/**
 * Input class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Input 
{
    private static $instance = null;
    private static $input = array();

    private function __construct()
    {
        $this->set('POST', $_POST);
        $this->set('GET', $_GET);
        $this->set('COOKIE', $_COOKIE);
    }
    
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        
        return self::$instance;
    }
    
    public static function data($method = 'POST', $key = null)
    {
        if($key === null)
        {
            return (isset(self::$input[$method])) ? self::$input[$method] : null;
        }
        
        return (isset(self::$input[$method][$key])) ? self::$input[$method][$key] : null;
    }

    public function post($key)
    {
        return self::data('POST', $key);
    }

    public function get($key)
    {
        return self::data('GET', $key);
    }

    public function cookie($key)
    {
        return self::data('COOKIE', $key);
    }

    public function method()
    {
        $method = strtoupper((isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) ? 
                                    $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : 
                                    $_SERVER['REQUEST_METHOD']);

        $_method = $this->post('_method');
        return ($method == 'POST' && isset($_method)) ? strtoupper($_method) : $method;
    }
    
    private function set($method_key = null, $data = array())
    {
        if(is_array($data))
        {
            foreach ($data as $key => $value)
            {
                self::$input[$method_key][$key] = $value;
            }
        }
    }
}
