<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include "connection.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $location_lost = $_POST['location_lost'];
    $date_lost = $_POST['date_lost'];
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $old_image = $_POST['old_image'];

    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "uploads/".$image);

    }else{

        $image = $old_image;

    }

    $query = "UPDATE items SET

    item_name='$item_name',
    category='$category',
    description='$description',
    location_lost='$location_lost',
    date_lost='$date_lost',
    contact='$contact',
    status='$status',
    image='$image'

    WHERE id='$id'";

    if(mysqli_query($conn,$query)){
                echo "<script>
                alert('Item Updated Successfully!');
                window.location='my_reports.php';
              </script>";

    }else{

        echo "<script>
                alert('Update Failed!');
                window.location='edit_item.php?id=$id';
              </script>";

    }

}else{

    header("Location: my_reports.php");
    exit();

}

?>