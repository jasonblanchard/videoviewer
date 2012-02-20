<html>
<head></head>
<body>

<?php

session_start();

require_once 'database.php';
require_once 'lib.php';

do {
$randomkey = randomvideo();
} while ($randomkey == $_SESSION['randomkey']);

$displayedvideo = new video;
$displayedvideo->id = $randomkey;
$displayedvideo->load_info();
echo $displayedvideo->embedcode;

# print_r($displayedvideo);



$_SESSION['randomkey'] = $randomkey;

mysql_close(load_mysql());

# listallvideos();


?>
















</body>
</html>
