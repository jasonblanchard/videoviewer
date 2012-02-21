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



function listallvideos() {
    include_once 'database.php';
    $query = mysql_query("SELECT * FROM videos");
    $rows = mysql_num_rows($query);
    for ($j = 0; $j < $rows; ++$j) {
            $row = mysql_fetch_row($query);
             echo 'Title: ' .        $row[1] . '<br />';
             echo 'Embed code: ' .   $row[2] . '<br />';
             echo 'Timestamp: ' .    $row[3] . '<br /><br />';
    }
}

function randomvideo() {
    include_once 'database.php';
    $query = mysql_query("SELECT * FROM videos");
    $values = mysql_num_rows($query);
    $randomkey = rand(1,$values);
    return $randomkey;
}

function addvideo($name,$embedcode) {
    include_once 'database.php';
    $selectall = mysql_query("SELECT * FROM videos");
    $total = mysql_num_rows($selectall)+1;
    $alter = mysql_query("ALTER TABLE videos AUTO_INCREMENT=$total") or die(mysql_error());
    $cleanembed = mysql_escape_string($embedcode);
    $query = "INSERT INTO videos(title,embed) VALUES('$name', '$cleanembed')";
    if (!mysql_query($query,load_mysql())) {
        echo "INSERT failed: $query<br />" .mysql_error() . "<br /><br />";
    }
}



?>
