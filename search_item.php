<?php
session_start();

include "connection.php";

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

$result = null;

if(isset($_POST['search'])){

    $search = $_POST['item_name'];

    $query = "SELECT * FROM items
              WHERE item_name LIKE '%$search%'
              OR category LIKE '%$search%'
              OR location_lost LIKE '%$search%'
              OR description LIKE '%$search%'
              ORDER BY id ASC";

    $result = mysqli_query($conn, $query);

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Search Items</title>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="sidebar.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body>


<?php include "sidebar.php"; ?>



<div class="main-content">



<div class="topbar">


<h1>
Search Items
</h1>


<div class="user-box">

<i class="fa-solid fa-user"></i>

<?php echo $_SESSION['email']; ?>

</div>


</div>





<div class="welcome-card">


<h2>
Search Item
</h2>



<form method="POST">



<input
type="text"
name="item_name"
placeholder="Search item name, category or location"
required>



<button type="submit" name="search">


<i class="fa-solid fa-magnifying-glass"></i>


Search


</button>



</form>



</div>





<?php


if($result){


if(mysqli_num_rows($result)>0){


echo "<div class='welcome-card'>";


echo "<h2>Search Result</h2>";



while($row = mysqli_fetch_assoc($result)){



echo "<div class='card'>";



if(!empty($row['image'])){


echo "<img src='uploads/".$row['image']."'
width='200'
height='150'
style='object-fit:cover;border-radius:10px;'>";



}else{


echo "<p><b>No Image</b></p>";


}




echo "


<h3>".$row['item_name']."</h3>


<p><b>Category:</b> ".$row['category']."</p>


<p><b>Description:</b> ".$row['description']."</p>


<p><b>Location:</b> ".$row['location_lost']."</p>


<p><b>Date:</b> ".$row['date_lost']."</p>


<p><b>Contact:</b> ".$row['contact']."</p>


";




if($row['status']=="Lost"){


echo "<p><b>Status:</b> <span style='color:red;font-weight:bold;'>Lost</span></p>";


}else{


echo "<p><b>Status:</b> <span style='color:green;font-weight:bold;'>Found</span></p>";


}




echo "


<br>


<a href='view_details.php?id=".$row['id']."' class='back-btn'>


View Details


</a>


</div>


<hr>


";



}


echo "</div>";



}else{



echo "


<div class='welcome-card'>


<h3>No Item Found</h3>


</div>


";



}


}



?>



</div>


</body>

</html>