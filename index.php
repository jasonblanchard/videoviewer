<html>
<head></head>
<body>

<a href="index.php">Random Video</a>

<?php

session_start();

require_once 'database.php';
require_once 'lib.php';

# Delete video if delete was selected

if ( isset($_POST['delete']) ) {
        $id = $_POST['id'];
        remove_video($_POST['id']);
}

if ( isset($_POST['play']) ) {
    $displayedvideo= new video;
    $displayedvideo->id = $_POST['playid'];
    $displayedvideo->load_info();


    echo $displayedvideo->embedcode."<br />";
    echo "PLAY THIS VIDEO";
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

<!-- Add a new video form -->

<br />
<form action="index.php" method="post">
Submit a video<br />
Title: <input type="text" name="title" /><br />
Embed code: <input type="text" name="embedcode" /><br />
<input type="submit" value="Add to database" />
</form><br /><br />


<?php

# Replaces double quotes with single quotes and sends input to mysql

if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['embedcode']) && !empty($_POST['embedcode'])) {
    $title=str_replace('"',"",$_POST['title']);
    $embedcode=str_replace('"',"'",$_POST['embedcode']);

    add_video($title, $embedcode);
}

#remove_video(16);

list_all_videos();

mysql_close(load_mysql());


?>
















</body>
</html>
