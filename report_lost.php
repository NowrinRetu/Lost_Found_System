```php
<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Report Lost Item</title>

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
Report Lost Item
</h1>

<div class="user-box">

<i class="fa-solid fa-user"></i>

<?php echo $_SESSION['email']; ?>

</div>

</div>

<div class="welcome-card">

<h2>
Report a New Item
</h2>

<p>
Please fill in all the required information.
</p>

</div>

<div class="welcome-card">

<form action="report_lost_process.php" method="POST" enctype="multipart/form-data">

<label>Item Name</label>

<input type="text" name="item_name" required>


<label>Category</label>

<input type="text" name="category" required>


<label>Description</label>

<input type="text" name="description" required>


<label>Location</label>

<input type="text" name="location_lost" required>


<label>Date</label>

<input type="date" name="date_lost" value="<?php echo date('Y-m-d'); ?>" readonly required>


<label>Contact Number</label>

<input type="text" name="contact" required>


<label>Status</label>

<select name="status" required>

<option value="Lost">
Lost
</option>

</select>


<label>Item Image</label>

<input type="file" name="image" accept="image/*" required>


<button type="submit" name="submit">

<i class="fa-solid fa-paper-plane"></i>

Submit Report

</button>

</form>

<div style="margin-top:20px; text-align:center;">

<a href="dashboard.php" class="back-btn">

<i class="fa-solid fa-arrow-left"></i>

Back to Dashboard

</a>

</div>

</div>

</div>

</body>

</html>
```
