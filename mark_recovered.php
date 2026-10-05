<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include "connection.php";

$email = $_SESSION['email'];

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $check = mysqli_query($conn,"SELECT * FROM items WHERE id='$id' AND email='$email'");

    if(mysqli_num_rows($check)==1){

        mysqli_query($conn,"UPDATE items SET status='Recovered' WHERE id='$id'");
    }
}

header("Location: my_reports.php");
exit();
?>