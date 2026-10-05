<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include "connection.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $email = $_SESSION['email'];

    // Get image name
    $check = mysqli_query($conn, "SELECT * FROM items WHERE id='$id' AND email='$email'");

    if(mysqli_num_rows($check) > 0){

        $row = mysqli_fetch_assoc($check);

        $image = $row['image'];

        // Delete image from uploads folder
        if(file_exists("uploads/".$image)){
            unlink("uploads/".$image);
        }

        // Delete item from database
        $delete = mysqli_query($conn, "DELETE FROM items WHERE id='$id' AND email='$email'");

        if($delete){

            echo "<script>
                    alert('Item Deleted Successfully!');
                    window.location='my_reports.php';
                  </script>";

        }else{

            echo "<script>
                    alert('Delete Failed!');
                    window.location='my_reports.php';
                  </script>";

        }

    }else{

        echo "<script>
                alert('Item Not Found!');
                window.location='my_reports.php';
              </script>";

    }

}else{

    header("Location: my_reports.php");
    exit();

}
?>