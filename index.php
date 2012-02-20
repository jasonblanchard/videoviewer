<html>
<head></head>
<body>

<?php

require_once 'database.php';
require_once 'lib.php';


$displayedvideo = new video;
$displayedvideo->id = 2;
$displayedvideo->load_info();
print_r($displayedvideo);

listallvideos();


?>
















</body>
</html>
