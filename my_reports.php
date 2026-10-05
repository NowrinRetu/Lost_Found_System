<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include "connection.php";

$email = $_SESSION['email'];

$query = "SELECT * FROM items WHERE email='$email' ORDER BY id ASC";
$result = mysqli_query($conn, $query);

$serial = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Reports</title>


<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="sidebar.css">


<style>

.action-buttons{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    flex-wrap:nowrap;
}


.action-buttons a{
    width:38px;
    height:38px;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:8px;
    color:#fff;
    text-decoration:none;
    font-size:14px;
    transition:0.3s;
}


.action-buttons a:hover{
    transform:scale(1.08);
}


.view-btn{ 
    background:#2563eb; 
}

.edit-btn{ 
    background:#16a34a; 
}

.delete-btn{ 
    background:#dc2626; 
}

.recover-btn{ 
    background:#7c3aed; 
}



.items-table th:last-child,
.items-table td:last-child{

    width:220px;
    min-width:220px;

}



.item-image{

    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:8px;
    border:1px solid #ddd;

}


</style>


</head>


<body>


<?php include "sidebar.php"; ?>



<div class="main-content">



<h1>
Lost & Found Management System
</h1>



<h2>
My Reported Items
</h2>




<table class="items-table">


<tr style="background:#0d47a1; color:white;">

<th>Serial</th>
<th>Image</th>
<th>Item Name</th>
<th>Category</th>
<th>Location</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>

</tr>



<?php while($row = mysqli_fetch_assoc($result)){ ?>


<tr>


<td>
<?php echo $serial++; ?>
</td>



<td>

<?php if(!empty($row['image'])){ ?>

<img src="uploads/<?php echo $row['image']; ?>" class="item-image">

<?php } else { ?>

No Image

<?php } ?>

</td>




<td>
<?php echo htmlspecialchars($row['item_name']); ?>
</td>



<td>
<?php echo htmlspecialchars($row['category']); ?>
</td>



<td>
<?php echo htmlspecialchars($row['location_lost']); ?>
</td>



<td>
<?php echo htmlspecialchars($row['date_lost']); ?>
</td>




<td>

<?php

if($row['status'] == "Lost"){

echo "<span style='color:red;font-weight:bold;'>Lost</span>";

}

elseif($row['status'] == "Found"){

echo "<span style='color:green;font-weight:bold;'>Found</span>";

}

else{

echo "<span style='color:blue;font-weight:bold;'>Recovered</span>";

}

?>

</td>




<td>


<div class="action-buttons">


<a href="view_details.php?id=<?php echo $row['id']; ?>" 
class="view-btn" 
title="View">

👁

</a>



<a href="edit_item.php?id=<?php echo $row['id']; ?>" 
class="edit-btn" 
title="Edit">

✏

</a>



<a href="delete_item.php?id=<?php echo $row['id']; ?>"
class="delete-btn"
title="Delete"
onclick="return confirm('Are you sure you want to delete this item?')">

🗑

</a>




<?php if($row['status'] != 'Recovered'){ ?>


<a href="mark_recovered.php?id=<?php echo $row['id']; ?>"
class="recover-btn"
title="Mark as Recovered"
onclick="return confirm('Mark this item as recovered?')">

✔

</a>


<?php } ?>


</div>


</td>



</tr>



<?php } ?>


</table>




<br>



<div style="text-align:center;">


<a href="dashboard.php">

Back to Dashboard

</a>


</div>



</div>



</body>

</html>