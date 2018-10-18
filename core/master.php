<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require ROOT . DS . 'core' . DS . 'Autoloader.php';

use Core\Autoloader;
use Core\Classes\Acher;

$loader = new Autoloader();

$loader->addNamespace('Core', ROOT . DS . 'core' . DS);
$loader->addNamespace('App', ROOT . DS . 'app' . DS);

$loader->register();

$acher = Acher::getInstance();

// Setup the required folders
$acher->setupFolders();

// Set the required configuration
$acher->setConfiguration();

// Setup the error handling 
$acher->setupErrorHandling();

// Process the http request
$acher->processHttpRequest();