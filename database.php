<?php

$db_hostname = 'localhost';
$db_database = 'videoapp';
$db_username = 'videoadmin';
$db_password = 'theentertainment';


function load_mysql() {
    $db_hostname = 'localhost';
    $db_database = 'videoapp';
    $db_username = 'videoadmin';
    $db_password = 'theentertainment';

    $db_server = mysql_connect($db_hostname,$db_username,$db_password);
    if (!$db_server) die("Unable to connect to MySQL: " .mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
}

load_mysql();

?>
