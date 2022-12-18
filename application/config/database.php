<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'hostname' => 'tag-fileshare-server.mysql.database.azure.com', // Your database connection address (can be an IP or hostname)
    'username' => 'vljbqdeuug', // The username to login with
    'password' => 'P26E4764U3P5M2JF$', // The password to login with
    'database' => 'tag-fileshare-database', // The name of the database
    'ssl_ca' => '/home/site/wwwroot/ssl/BaltimoreCyberTrustRoot.crt.pem',

    /*
    !!! Do not edit anything below without knowing what you're doing !!!
    */
    'dbdriver' => 'mysql',
    'dsn'	   => '',
    'dbprefix' => '',
    'pconnect' => TRUE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => TRUE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
