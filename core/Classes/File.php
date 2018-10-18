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
 * Security class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class File
{
    private static $loaded = array();

    public static function getLoadedFilesByType($type)
    {
        return self::$loaded[$type];
    }
    
    public static function load($file_name, $file_path, $type = 'file')
    {
        if(empty($file_name))
        {
            throw new \Exception('The file name is empty.');
        }

        if( ! array_key_exists($type, self::$loaded))
        {
            self::$loaded[$type] = array();
        }

        if(array_key_exists($file_name, self::$loaded[$type]))
        {
            return self::$loaded[$type][$file_name];
        }

        if ( ! file_exists($file_path))
        {
            throw new \Exception('This file "' . $file_path . '" does not exists.');
        }

        return self::$loaded[$type][$file_name] = require $file_path;
    }
}
