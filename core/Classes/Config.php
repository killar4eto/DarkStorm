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
 * Config class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Config
{
    private static $folder = null;
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }

    public static function getFolder()
    {
        return self::$folder;
    }
	
    public static function load($file_name)
    {
        $file_path =  self::getFolder() . $file_name . '.php';
        return File::load($file_name, $file_path, 'config');
    }

    public static function get($config)
    {
        if((is_string($config) && strpos($config, '.')) === false)
        {
            throw new \Exception('Wrong format of Config::get() it has to be file_name.array_key but it is "' . $config . '".', 1);
        }

        list($file, $var) = explode('.', $config);

        $loaded = self::load($file);
        
        if (array_key_exists($var, $loaded))
        {
            return $loaded[$var];
        }
        
        return null;
    }
}
