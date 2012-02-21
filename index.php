<html>
<head></head>
<body>

<?php

session_start();

require_once 'database.php';
require_once 'lib.php';

do {
$randomkey = random_video();
} while ($randomkey == $_SESSION['randomkey']);

$displayedvideo = new video;
$displayedvideo->id = $randomkey;
$displayedvideo->load_info();
echo $displayedvideo->embedcode."<br />";

# print_r($displayedvideo);



$_SESSION['randomkey'] = $randomkey;



$name = "Carl Sagan - Pale Blue Dot";
$embedcode = "<iframe width='420' height='315' src='http://www.youtube.com/embed/p86BPM1GV8M' frameborder='0' allowfullscreen></iframe>";

add_video($name, $embedcode);


/*
$title = "Family Guy - I Love You (star wars)";
remove_video($title);
*/

list_all_videos();

mysql_close(load_mysql());


?>
















</body>
</html>
