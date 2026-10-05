<?php
include "connection.php";

$query = "SELECT * FROM items ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$serial = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Items</title>

    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sidebar.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

    <!-- HEADER -->
    <div class="topbar">
        <h1>Lost & Found Management System</h1>
    </div>

    <!-- TITLE -->
    <h2 style="margin-top:30px;">All Reported Items</h2>

    <!-- TABLE -->
    <div class="table-container">

        <table class="items-table">

            <tr>
                <th>Serial</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Location</th>
                <th>Date</th>
                <th>Contact</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <tr>

                <td><?php echo $serial++; ?></td>

                <td><?php echo htmlspecialchars($row['item_name']); ?></td>

                <td><?php echo htmlspecialchars($row['category']); ?></td>

                <td class="description-cell">
                    <?php echo htmlspecialchars($row['description']); ?>
                </td>

                <td><?php echo htmlspecialchars($row['location_lost']); ?></td>

                <td><?php echo htmlspecialchars($row['date_lost']); ?></td>

                <td><?php echo htmlspecialchars($row['contact']); ?></td>

                <td>

                    <?php if(!empty($row['image'])){ ?>

                        <img src="uploads/<?php echo $row['image']; ?>" class="item-image">

                    <?php } else { ?>

                        <span style="color:#64748b;">No Image</span>

                    <?php } ?>

                </td>

                <td>

                    <?php
                    if($row['status'] == "Lost"){
                        echo "<span class='lost'>Lost</span>";
                    }
                    elseif($row['status'] == "Found"){
                        echo "<span class='found'>Found</span>";
                    }
                    else{
                        echo "<span class='recovered'>Recovered</span>";
                    }
                    ?>

                </td>

                <td>

                    <a class="view-btn"
                       href="view_details.php?id=<?php echo $row['id']; ?>">

                        View Details

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

    <br>

    <!-- BACK BUTTON -->
    <div style="text-align:center;">

        <a class="back-btn" href="dashboard.php">

            Back to Dashboard

        </a>

    </div>

</div>

<style>

.table-container{
    width:100%;
    overflow-x:auto;
    margin-top:20px;
}

.items-table{
    width:100%;
    min-width:1200px;
    border-collapse:collapse;
    background:white;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 20px 45px rgba(15,23,42,.10);
}

.items-table th{
    background:#2563eb;
    color:white;
    padding:16px 14px;
    text-align:center;
    font-size:15px;
    white-space:nowrap;
}

.items-table td{
    padding:16px 14px;
    text-align:center;
    vertical-align:middle;
    border-bottom:1px solid #e5e7eb;
    white-space:nowrap;
}

.description-cell{
    white-space:normal !important;
    max-width:220px;
    line-height:1.5;
    color:#334155;
}

.items-table tr:hover{
    background:#f8fbff;
}

/* Status badges */

.lost,
.found,
.recovered{
    display:inline-block;
    padding:8px 16px;
    border-radius:999px;
    font-weight:700;
    font-size:14px;
    white-space:nowrap;
    min-width:100px;
    text-align:center;
}

.lost{
    background:#fee2e2;
    color:#dc2626;
}

.found{
    background:#dcfce7;
    color:#16a34a;
}

.recovered{
    background:#dbeafe;
    color:#2563eb;
}

/* Image */

.item-image{
    width:62px;
    height:62px;
    object-fit:cover;
    border-radius:14px;
    border:2px solid #e5e7eb;
    background:#fff;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

/* View button */

.view-btn{
    display:inline-block;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:white;
    padding:10px 18px;
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
    white-space:nowrap;
    min-width:118px;
    text-align:center;
    box-shadow:0 8px 18px rgba(37,99,235,.25);
    transition:all .25s ease;
}

.view-btn:hover{
    transform:translateY(-2px);
}

/* Back button */

.back-btn{
    display:inline-block;
    background:#0f172a;
    color:white;
    padding:12px 22px;
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
}

.back-btn:hover{
    background:#020617;
}

/* Responsive */

@media(max-width:768px){

    .items-table{
        min-width:1050px;
    }

    .view-btn{
        min-width:110px;
        padding:10px 14px;
    }
}

</style>

</body>
</html>