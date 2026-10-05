
<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "lost_found_db"
);

if(!$conn){
    die("Database connection failed");
}

?>