<?php
include "connection.php";

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM items");
$reported = mysqli_fetch_assoc($result)['total'];

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM items WHERE status='Found'");
$recovered = mysqli_fetch_assoc($result)['total'];

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$users = mysqli_fetch_assoc($result)['total'];
?>


<!DOCTYPE html>
<html>
<head>

<title>Lost & Found Management System</title>

<link rel="stylesheet" href="home.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body>


<header>

<div class="logo">

<i class="fa-solid fa-location-dot"></i>

Lost & Found

</div>



<nav>

<a href="login.php">
Login
</a>


<a href="register.php" class="signup">
Register
</a>


</nav>

</header>





<section class="hero">



<div class="hero-content">



<h1>

Every Lost Item

<br>

<span>
Has A Way Back Home.
</span>

</h1>



<p>

A smart Lost & Found Management System
to report, search and recover lost items easily.

</p>




<div class="action">


<a href="login.php" class="primary">

<i class="fa-solid fa-right-to-bracket"></i>

Get Started

</a>




<a href="login.php" class="secondary">

<i class="fa-solid fa-box"></i>

Report Lost Item

</a>



</div>



</div>






<div class="visual">



<div class="circle">

<i class="fa-solid fa-location-dot"></i>

</div>





<div class="floating-card card1">


<i class="fa-solid fa-mobile-screen"></i>


<div>

<h3>
Phone Lost
</h3>

<p>
Campus Area
</p>

</div>


</div>






<div class="floating-card card2">


<i class="fa-solid fa-wallet"></i>


<div>

<h3>
Wallet Found
</h3>

<p>
Library Zone
</p>

</div>


</div>







<div class="search-card">

<form action="login.php" method="GET">

    <input
        type="text"
        name="search"
        placeholder="Search Lost Items..."
        class="search-input"
    >

    <button type="submit" class="search-btn">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>

</form>

</div>


</div>



</section>
<section class="stats">

    <div class="stat-box">
        <h2><?php echo $reported; ?></h2>
        <p>Reported Items</p>
    </div>

    <div class="stat-box">
        <h2><?php echo $recovered; ?></h2>
        <p>Recovered Items</p>
    </div>

    <div class="stat-box">
        <h2><?php echo $users; ?></h2>
        <p>Registered Users</p>
    </div>

</section>


<section class="about">

    <h2>Why Choose Our System?</h2>

    <div class="about-box">

        <div>
            <i class="fa-solid fa-shield-halved"></i>
            <h3>Secure Login</h3>
            <p>Safe authentication for every user.</p>
        </div>

        <div>
            <i class="fa-solid fa-magnifying-glass"></i>
            <h3>Quick Search</h3>
            <p>Find lost items quickly and easily.</p>
        </div>

        <div>
            <i class="fa-solid fa-box-open"></i>
            <h3>Easy Reporting</h3>
            <p>Report lost items with just a few clicks.</p>
        </div>

    </div>

</section>


<footer>

   <p>© 2026 Lost & Found Management System</p>
<p>All Rights Reserved.</p>

</footer>







<section class="features">



<a href="login.php">


<div>

<i class="fa-solid fa-magnifying-glass"></i>

<h3>
Search Items
</h3>

<p>
Find lost belongings quickly
</p>


</div>


</a>







<a href="login.php">


<div>


<i class="fa-solid fa-box"></i>


<h3>
Report Lost Item
</h3>


<p>
Submit lost item details
</p>



</div>


</a>








<a href="login.php">


<div>


<i class="fa-solid fa-location-dot"></i>


<h3>
Manage Lost Items
</h3>

<p>
View and manage reported items
</p>



</div>


</a>






</section>





</body>

</html>