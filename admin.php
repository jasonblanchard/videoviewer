<html>
<head></head>
<body>

<?php

require_once 'database.php';
require_once 'lib.php';

if ( isset($_POST['delete']) ) {
    remove_video($_POST['id']);
}

?>

<!-- Add a new video form -->

<br />
<form action="admin.php" method="post">
<h1>Add a video</h1><br />
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


?><h1>Video Library</h1><?php
list_all_videos_with_admin();

?>
</body>
</html>
