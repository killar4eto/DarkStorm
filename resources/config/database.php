<?php

return array(
    'server' => 'DESKTOP-TFT19OE\SQLEXPRESS',
    'username' => null,
    'password' => null,
    'options' => array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_WARNING ,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
            #\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
);