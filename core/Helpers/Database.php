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

use Core\Classes\Config;
/**
 * Database class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Database extends \PDO 
{
    public function __construct()
    {
        $db_config = Config::load('database');
		$username = $db_config['username'];
		$password = $db_config['password'];
		$dsn = $db_config['dsn'];
        $options = $db_config['options'];
        
        parent::__construct($dsn, $username, $password, $options);
    }
}
