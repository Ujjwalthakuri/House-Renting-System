<?php
include "../connect.php";
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, email, password, status, role FROM user WHERE email='{$email}' AND password='{$password}'";

    $result = mysqli_query($con, $sql) or die("Query Field");

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            // session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['status'] = $row['status'];

            if ($row["role"] == "admin") {
                $_SESSION['admin_name'] = $email;
                header("location:../Admin_Folder/admin-home.php");
                exit;
            }
            elseif($row["role"] == "owner"  AND $row["status"]=="accept"){
                $_SESSION['admin_name'] = $email;
                header("location:../owner_folder/owner-home.php");
                exit;
            }elseif($row["role"] == "renter" AND $row["status"]=="accept"){
                $_SESSION['admin_name'] = $email;
                header("location:../Tenant_Folder/tenant-home.php");
                exit;
            }

        }
    }
    else{
        echo "<script>alert('User name or password are not match')</script> ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- css-link -->
     <link rel="stylesheet" href="signin-style.css">
</head>
<body>

    <section class="form-container">
        <h1 class="signin">Sign In</h1>
            <form action="#" method="post" class="form-start">
                <label for="" class="form-item">Email:</label><br>
                <input type="email" id="email" class="input-item" name="email" placeholder="Entar your Email">
                <br>
                <label for="" class="form-item">Password:</label><br>
                <input type="password" id="password" class="input-item" name="password" placeholder="Entar your Password"> 
                <br>
                <input type="submit" class="btn" id="submit" name="submit" value="Sign in">
                <button class="btn back"><a href="../Home/home.php"> Back </a> </button>
            </form>
    </section>
    
    <script src="../signin/signin-script.js"></script>
</body>
</html>

