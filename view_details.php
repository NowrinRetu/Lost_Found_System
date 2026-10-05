<?php
session_start();
include "connection.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = "SELECT * FROM items WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

}else{
    echo "No Item Selected!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Item Details</title>

    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="details-card">

<h2>Item Details</h2>

<?php if(!empty($row['image'])){ ?>

<img src="uploads/<?php echo $row['image']; ?>" 
alt="Item Image"
style="width:250px;
height:250px;
object-fit:cover;
border-radius:15px;
display:block;
margin:20px auto;">

<?php } else { ?>

<p style="text-align:center;">No Image Available</p>

<?php } ?>

<hr>

<br>

<p><strong>🆔 Item ID:</strong> <?php echo $row['id']; ?></p>

<p><strong>📦 Item Name:</strong> <?php echo $row['item_name']; ?></p>

<p><strong>📂 Category:</strong> <?php echo $row['category']; ?></p>

<p><strong>📝 Description:</strong> <?php echo $row['description']; ?></p>

<p><strong>📍 Lost Location:</strong> <?php echo $row['location_lost']; ?></p>

<p><strong>📅 Date Lost:</strong> <?php echo $row['date_lost']; ?></p>

<p><strong>📞 Contact Number:</strong> <?php echo $row['contact']; ?></p>

<p><strong>📧 Reported By:</strong> <?php echo $row['email']; ?></p>

<p>
<strong>📌 Status:</strong>

<?php
if($row['status']=="Lost"){
    echo "<span class='status-lost'>Lost</span>";
}elseif($row['status']=="Found"){
    echo "<span class='status-found'>Found</span>";
}else{
    echo "<span class='status-found'>Recovered</span>";
}
?>

</p>

<?php
if(isset($_SESSION['email']) && 
   $row['status'] == "Lost" && 
   $row['email'] == $_SESSION['email']){
?>

<div style="text-align:center; margin-top:20px;">

<a href="mark_recovered.php?id=<?php echo $row['id']; ?>" class="back-btn">

✅ Mark as Recovered

</a>

</div>

<?php } ?>

<p><strong>🕒 Reported On:</strong> <?php echo $row['created_at']; ?></p>

<div style="text-align:center; margin-top:25px;">

<a href="view_items.php" class="back-btn">
⬅ Back to View Items
</a>

</div>

</div>

</div>

</body>
</html>