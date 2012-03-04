<html>
<head><link href='http://fonts.googleapis.com/css?family=Raleway:100|Varela|Muli' rel='stylesheet' type='text/css'> <link href='videoviewer.css' rel='stylesheet' type='text/css'></head>
<body>

<div class="header">
<h1><a href="index.php">Random Video</a></h1>
<br />
</div>

<?php

session_start();

require_once 'database.php';
require_once 'lib.php';

# Delete video if delete was selected

?>

<div class="video">
<?php
if ( isset($_POST['play']) ) {
    $displayedvideo= new video;
    $displayedvideo->id = $_POST['playid'];
    $displayedvideo->load_info();


    echo $displayedvideo->embedcode."<br />";
}

# Select a random video to display

elseif (!isset($POST_['play'])) {
    if (isset($_SESSION['randomkey'])) {
        do {
        $randomkey = random_video();
        } while ($randomkey == $_SESSION['randomkey']);
    } else {
        $randomkey = random_video();
    }

    $displayedvideo = new video;
    $displayedvideo->id = $randomkey;
    $displayedvideo->load_info();

    echo $displayedvideo->embedcode."<br />";

    $_SESSION['randomkey'] = $randomkey;
}

?>
</div>

<?php

echo "<br />";
echo "<br />";
echo "<br />";
list_all_videos();

mysql_close(load_mysql());


?>
















</body>
</html>
