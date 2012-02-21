<html>
<head></head>
<body>

<a href="index.php">Reload</a>

<?php

session_start();

require_once 'database.php';
require_once 'lib.php';

# Select a random video to display

do {
$randomkey = random_video();
} while ($randomkey == $_SESSION['randomkey']);

$displayedvideo = new video;
$displayedvideo->id = $randomkey;
$displayedvideo->load_info();

echo $displayedvideo->embedcode."<br />";

$_SESSION['randomkey'] = $randomkey;

?>

<!-- Add a new video form -->

<br />
<form action="index.php" method="post">
Submit a video<br />
Title: <input type="text" name="title" /><br />
Embed code: <input type="text" name="embedcode" /><br />
<input type="submit" value="Add to database" />
<br /><br />


<?php

# Replaces double quotes with single quotes and sends input to mysql

if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['embedcode']) && !empty($_POST['embedcode'])) {
    $title=str_replace('"',"",$_POST['title']);
    $embedcode=str_replace('"',"'",$_POST['embedcode']);

    add_video($title, $embedcode);
}


/*
$title = "Family Guy - I Love You (star wars)";
remove_video($title);
*/

list_all_videos();

mysql_close(load_mysql());


?>
















</body>
</html>
