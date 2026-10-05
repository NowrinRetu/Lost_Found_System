<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include "connection.php";

$email = $_SESSION['email'];

// USER NAME
$user_query = mysqli_query($conn, "SELECT name FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($user_query);

$username = $user['name'] ?? "User";

// COUNTS
$total = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM items"));

$lost = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS lost FROM items WHERE status='Lost'"));

$found = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS found FROM items WHERE status='Found'"));

$recovered = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS recovered FROM items WHERE status='Recovered'"));

$my = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS my FROM items WHERE email='$email'"));

// RECENT REPORTS
$recent = mysqli_query($conn,
    "SELECT item_name, status, date_lost
     FROM items
     ORDER BY id DESC
     LIMIT 5"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Premium Dashboard</title>

    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="sidebar.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

    <!-- HEADER -->
    <div class="topbar">

        <div>
            <h1>
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </h1>

            <p class="subtitle">
                Lost & Found Management System
            </p>
        </div>

        <div class="profile-box">

            <div class="profile-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <h4><?php echo htmlspecialchars($username); ?></h4>
                <span>Active User</span>
            </div>

        </div>

    </div>

    <!-- WELCOME CARD -->
    <div class="welcome-card">

        <div class="welcome-content">

            <h2>
                Hello, <?php echo htmlspecialchars($username); ?> 👋
            </h2>

            <p>
                We're glad to have you here. Manage lost and found records, report new items,
                search reports, and help return belongings to their rightful owners with ease and confidence.
            </p>

        </div>

        <i class="fa-solid fa-box-open welcome-icon"></i>

    </div>

    <!-- STATISTICS -->
    <div class="stats">

        <div class="stat-card blue">
            <i class="fa-solid fa-box"></i>
            <div>
                <h3>Total Items</h3>
                <h2><?php echo $total['total']; ?></h2>
            </div>
        </div>

        <div class="stat-card red">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <h3>Lost Items</h3>
                <h2><?php echo $lost['lost']; ?></h2>
            </div>
        </div>

        <div class="stat-card green">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <div>
                <h3>Found Items</h3>
                <h2><?php echo $found['found']; ?></h2>
            </div>
        </div>

        <div class="stat-card purple">
            <i class="fa-solid fa-circle-check"></i>
            <div>
                <h3>Recovered</h3>
                <h2><?php echo $recovered['recovered']; ?></h2>
            </div>
        </div>

        <div class="stat-card orange">
            <i class="fa-solid fa-file-lines"></i>
            <div>
                <h3>My Reports</h3>
                <h2><?php echo $my['my']; ?></h2>
            </div>
        </div>

    </div>

    <!-- QUICK ACTION -->
    <h2 class="section-title">Quick Actions</h2>

    <div class="cards">

        <a href="report_lost.php" class="card">
            <i class="fa-solid fa-circle-plus"></i>
            <h3>Report Lost Item</h3>
            <p>Submit lost item details</p>
        </a>

        <a href="report_found.php" class="card">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <h3>Report Found Item</h3>
            <p>Help someone recover items</p>
        </a>

        <a href="view_items.php" class="card">
            <i class="fa-solid fa-list"></i>
            <h3>View Items</h3>
            <p>Browse all reports</p>
        </a>

        <a href="search_item.php" class="card">
            <i class="fa-solid fa-magnifying-glass"></i>
            <h3>Search Item</h3>
            <p>Find missing items</p>
        </a>

        <a href="my_reports.php" class="card">
            <i class="fa-solid fa-file-lines"></i>
            <h3>My Reports</h3>
            <p>Manage your reports</p>
        </a>

        <a href="logout.php" class="card logout-card">
            <i class="fa-solid fa-right-from-bracket"></i>
            <h3>Logout</h3>
            <p>Exit account</p>
        </a>

    </div>

    <!-- RECENT REPORTS -->
    <div class="recent-section">

        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:20px;">

            <h2 style="margin:0;">
                <i class="fa-solid fa-clock-rotate-left" style="margin-right:10px;"></i>
                Recent Reports
            </h2>

            <span style="background:#dbeafe;color:#1d4ed8;padding:8px 14px;border-radius:20px;font-weight:700;font-size:14px;">
                Latest 5
            </span>

        </div>

        <table class="recent-table">

            <tr>
                <th>Item</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <?php while($r = mysqli_fetch_assoc($recent)){ ?>

            <tr>

                <td style="font-weight:600;">
                    <?php echo htmlspecialchars($r['item_name']); ?>
                </td>

                <td>

                    <?php
                    if($r['status'] == "Lost"){
                        echo "<span class='lost'>Lost</span>";
                    }
                    elseif($r['status'] == "Found"){
                        echo "<span class='found'>Found</span>";
                    }
                    else{
                        echo "<span class='recovered'>Recovered</span>";
                    }
                    ?>

                </td>

                <td>
                    <?php echo date("d M Y", strtotime($r['date_lost'])); ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>