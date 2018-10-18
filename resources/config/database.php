<?php

return array(
    'dsn' => 'mysql:host=localhost;dbname=acher;charset=utf8',
    'username' => 'root',
    'password' => 'toor',
    'options' => array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_WARNING ,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
);