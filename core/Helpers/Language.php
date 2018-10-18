<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Helpers;
use Core\Classes\File;
/**
 * Lang class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Language
{
    private static $folder = null;
    private $language = null;

    public function __construct($language)
    {
        $this->set($language);
    }

    public function set($language)
    {
        $this->language = $language;
    }

    public function get()
    {
        return $this->language;
    }
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }

    public static function getFolder()
    {
        return self::$folder;
    }
    
    public function load($file_name)
    {
        $file_path = self::getFolder() . $this->get() . DS . $file_name . '.php';
        return File::load($file_name, $file_path, 'language');
    }
    
    public function translate($lang, $data = null)
    {
        list($file, $var) = explode('.', $lang);

        $loaded = $this->load($file);
        
        if (array_key_exists($var, $loaded))
        {
            if(is_array($data))
            {
                array_unshift($data, $loaded[$var]);
                return call_user_func_array('sprintf', $data);
            }
            return sprintf($loaded[$var], $data);
        }
        
        return $data;
    }
}
