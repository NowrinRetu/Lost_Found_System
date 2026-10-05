<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include "connection.php";

if(!isset($_GET['id'])){
    header("Location: my_reports.php");
    exit();
}

$id = $_GET['id'];
$email = $_SESSION['email'];

$query = "SELECT * FROM items WHERE id='$id' AND email='$email'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)==0){
    echo "Item not found!";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Item</title>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="topbar">

<h1>Edit Item</h1>

<div class="user-box">
<i class="fa-solid fa-user"></i>
<?php echo $_SESSION['email']; ?>
</div>

</div>

<div class="welcome-card">

<h2>Edit Reported Item</h2>

<p>Update your item information below.</p>

</div>

<div class="welcome-card">

<form action="update_item.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">

<label>Item Name</label>
<input type="text" name="item_name"
value="<?php echo $row['item_name']; ?>" required>

<label>Category</label>
<input type="text" name="category"
value="<?php echo $row['category']; ?>" required>

<label>Description</label>
<input type="text" name="description"
value="<?php echo $row['description']; ?>" required>

<label>Location</label>
<input type="text" name="location_lost"
value="<?php echo $row['location_lost']; ?>" required>

<label>Date</label>
<input type="date" name="date_lost"
value="<?php echo $row['date_lost']; ?>" required>

<label>Contact</label>
<input type="text" name="contact"
value="<?php echo $row['contact']; ?>" required>

<label>Status</label>

<select name="status">

<option value="Lost"
<?php if($row['status']=="Lost") echo "selected"; ?>>
Lost
</option>

<option value="Found"
<?php if($row['status']=="Found") echo "selected"; ?>>
Found
</option>

</select>

<br><br>

<label>Current Image</label>

<br>

<img src="uploads/<?php echo $row['image']; ?>"
width="120"
style="border-radius:10px;">

<br><br>

<label>Choose New Image (Optional)</label>

<input type="file" name="image" accept="image/*">
<button type="submit" class="back-btn">
<i class="fa-solid fa-floppy-disk"></i>
Update Item
</button>

</form>

<br>

<div style="text-align:center;">

<a href="my_reports.php" class="back-btn">
<i class="fa-solid fa-arrow-left"></i>
Back to My Reports
</a>

</div>

</div>

</div>

</body>
</html>