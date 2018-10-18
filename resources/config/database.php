<?php

return array(
    'dsn' => 'sqlsrv:Server=127.0.0.1;Database=MuOnline',
    'username' => 'sa',
    'password' => 'kalo',
    'options' => array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_WARNING ,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
            #\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
);