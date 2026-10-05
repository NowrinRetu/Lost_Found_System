<?php

include "connection.php";

session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Find user by email
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        // Check normal password or MD5 password
        if($password == $user['password'] || md5($password) == $user['password']){

            $_SESSION['email'] = $email;

            header("Location: dashboard.php");
            exit();

        }else{

            $error = "Invalid Email or Password!";

        }

    }else{

        $error = "Invalid Email or Password!";

    }

}

?>


<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<div class="container">


    <h2>Login</h2>


    <?php

    if(isset($error)){

        echo "<p style='color:red;'>$error</p>";

    }

    ?>


    <form method="POST">


        <input 
        type="email" 
        name="email" 
        placeholder="Enter Email" 
        required>


        <input 
        type="password" 
        name="password" 
        placeholder="Enter Password" 
        required>


        <button type="submit" name="login">
            Login
        </button>


    </form>


    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>


</div>


</body>

</html>