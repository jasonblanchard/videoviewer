<?php

require_once 'database.php';


class video {
    public $id;
    public $title;
    public $embedcode;
    public $timestamp;


    public function load_info() {
        include_once 'database.php';
        $query = "SELECT * FROM videos WHERE id=".$this->id;
        $result = mysql_query($query);
        if (!$result) die("Database access failed: " . mysql_error());
        $row = mysql_fetch_row($result);
        
        $this->title = $row[1];
        $this->embedcode = $row[2];
        $this->timestamp = $row[3];
    }
}

function list_all_videos() {
    include_once 'database.php';
    $query = mysql_query("SELECT * FROM videos ORDER BY timestamp desc");
    $rows = mysql_num_rows($query);
    for ($j = 0; $j < $rows; ++$j) {
        $row = mysql_fetch_row($query);
        echo 'ID: ' .           $row[0] . '<br />';
        echo 'Title: ' .        $row[1] . '<br />';
        echo 'Timestamp: ' .    $row[3] . '<br />';
        ?>
        <form action="index.php" method="post">
        <input type="hidden" name="play" value="yes" />
        <?php echo "<input type='hidden' name='playid' value='$row[0]' />";?>
        <input type="submit" value="Play Video" /></form>
        <?php
    }
}





function list_all_videos_with_delete() {
    include_once 'database.php';
    $query = mysql_query("SELECT * FROM videos ORDER BY timestamp desc");
    $rows = mysql_num_rows($query);
    for ($j = 0; $j < $rows; ++$j) {
            $row = mysql_fetch_row($query);
            echo 'ID: ' .           $row[0] . '<br />';
            echo 'Title: ' .        $row[1] . '<br />';
            echo 'Timestamp: ' .    $row[3] . '<br />';
            ?>
            <form action="index.php" method="post">
            <input type="hidden" name="play" value="yes" />
            <?php echo "<input type='hidden' name='playid' value='$row[0]' />";?>
            <input type="submit" value="Play Video" /></form>

            <form action="admin.php" method="post">
            <input type="hidden" name="delete" value="yes" />
            <?php echo "<input type='hidden' name='id' value='$row[0]' />";?>
            <input type="submit" value="Delete Video" /></form>
            <br /><br />
            <?php
    }
}


function random_video() {
    include_once 'database.php';
    $query = mysql_query("SELECT * FROM videos");
    $values = mysql_num_rows($query)-1;
    $randomkey = rand(1,$values);
    $row = mysql_query("SELECT * FROM videos LIMIT 1 OFFSET $randomkey");
    if ( !$row ) echo "This isn't right " . mysql_error();

    $mysqlrow = mysql_fetch_row($row);
    $rowkey = $mysqlrow[0];
    return $rowkey;
    
}

function add_video($title,$embedcode) {
    include_once 'database.php';

    $escapedcode = str_replace('"',"'",$embedcode);

    $cleanembed = mysql_escape_string($escapedcode);
    $cleantitle = mysql_escape_string($title);

    $test1 = mysql_query("SELECT title FROM videos WHERE title='$cleantitle'");
    $test2 = mysql_query("SELECT title FROM videos WHERE embed='$cleanembed'");

    if (mysql_num_rows($test1) || (mysql_num_rows($test2))) {
        return "That video is already in the database";
    } else {
        $selectall = mysql_query("SELECT * FROM videos");
        $total = mysql_num_rows($selectall)+1;
        $alter = mysql_query("ALTER TABLE videos AUTO_INCREMENT=$total") or die(mysql_error());
        $query = "INSERT INTO videos(title,embed) VALUES('$cleantitle', '$cleanembed')";
        if (!mysql_query($query,load_mysql())) {
            echo "INSERT failed: $query<br />" .mysql_error() . "<br /><br />";
        }
    }
}


function remove_video($id) {
    $query = "DELETE FROM videos WHERE id='$id'";
    if (!mysql_query($query,load_mysql())) { 
        echo "DELETE failed: $query<br />" .mysql_error() . "<br /><br />";
    }
        
        $selectall = mysql_query("SELECT * FROM videos");
        $total = mysql_num_rows($selectall)+1;
        $alter = mysql_query("ALTER TABLE videos AUTO_INCREMENT=$total") or die(mysql_error());
}
    
            
?>
