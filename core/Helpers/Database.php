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
    public function __construct($database)
    {
        $db_config = Config::load('database');
		$server = $db_config['server'];
        $options = $db_config['options'];
        $dsn = 'odbc:Driver={SQL Server};Server=' . $server . ';Database=' . $database . ';';
        parent::__construct($dsn, null, null, $options);
    }
}
