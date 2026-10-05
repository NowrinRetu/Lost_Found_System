<?php
include("config.php");

$message = "";

if (isset($_POST['register'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check duplicate email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {

        $message = "<div class='error'>
                        Email already exists!
                    </div>";

    } else {

        $password = md5($password);

        $insert = mysqli_query($conn,
        "INSERT INTO users(name,email,password)
        VALUES('$name','$email','$password')");

        if($insert){

            $message = "<div class='success'>
                            Registration Successful!
                        </div>";

        }else{

            $message = "<div class='error'>
                            Registration Failed!
                        </div>";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="form-box">

        <h2>Create Account</h2>

        <?php echo $message; ?>

        <form method="POST">

            <input
                type="text"
                name="name"
                placeholder="Enter Name"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Enter Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Enter Password"
                required
            >

            <button
                type="submit"
                name="register"
            >
                Register
            </button>

        </form>

        <p>
            Already have an account?
            <a href="login.php">Login Here</a>
        </p>
            </div>

</div>

</body>

</html>