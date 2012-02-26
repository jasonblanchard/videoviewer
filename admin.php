<html>
<head></head>
<body>

<?php

require_once 'database.php';
require_once 'lib.php';

if ( isset($_POST['delete']) ) {
    remove_video($_POST['id']);
}

list_all_videos_with_delete();


