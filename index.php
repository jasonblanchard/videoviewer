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



$urlstring = str_replace('"',"'",'<iframe width="420" height="315" src="http://www.youtube.com/embed/Jui-giDd26A" frameborder="0" allowfullscreen></iframe>');
$title = "Family Guy - I Love You (star wars)";

addvideo($title, $urlstring);

listallvideos();

mysql_close(load_mysql());


?>
















</body>
</html>
