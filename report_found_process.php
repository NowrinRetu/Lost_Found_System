```php
<?php
session_start();
include "connection.php";

if(isset($_POST['submit'])){

    $email = $_SESSION['email'];

    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $location_found = $_POST['location_found'];
    $contact = $_POST['contact'];

    // Automatically use today's date
    $date_found = date('Y-m-d');

    // Status
    $status = "Found";


    // Image Upload
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $target = "uploads/" . $image;

    move_uploaded_file($temp_name, $target);


    // Insert Found Item into database
    $query = "INSERT INTO items
              (item_name, category, description, location_lost, date_lost, contact, status, email, image)
              VALUES
              ('$item_name',
               '$category',
               '$description',
               '$location_found',
               '$date_found',
               '$contact',
               '$status',
               '$email',
               '$image')";


    if(mysqli_query($conn, $query)){

        echo "<script>
                alert('Found Item Report Submitted Successfully!');
                window.location='dashboard.php';
              </script>";

    }else{

        echo "Error: " . mysqli_error($conn);

    }

}

?>
```
