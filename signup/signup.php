<?php
include('../connect.php'); // Include the connect.php file from the parent folder
if(isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password']; 
    $status = "pending...";
    $role=$_POST['role'];
    $emailCheck = "select * from user where email='$email' ";
    $emailCheck_check = mysqli_query($con, $emailCheck);
    if(mysqli_num_rows($emailCheck_check)>0){ echo "Email already exist"; }
    else{

    $sql = "insert into user (fname, lname, address, phone, email, password, status, role) 
    values('$fname', '$lname', '$address', '$phone', '$email', '$password', '$status', '$role') ";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "Data Inserted";
    }else{
        die(mysqli_error($con));
    }
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <!-- css-link -->
     <link rel="stylesheet" href="../signup/signup-style.css">
</head>
<body>
    <div class="signup">
    <div class="registration">
        <h1 class="reg-su">Sign Up</h1>
        <form action="#" method="post" id="form">
            <div class="reg-detail">
                <div class="reg-input">
                    <label for="">First Name</label>
                    <input type="text" id="fname" class="input-field" name="fname" placeholder="First Name"><br>
                    <span id="one"></span>
                </div>
                <div class="reg-input">
                    <label for="">Last Name</label>
                    <input type="text" id="lname" class="input-field" name="lname" placeholder="Last Name"><br>
                    <span id="two"></span>
                </div>
                <div class="reg-input">
                    <label for="">Address</label>
                    <input type="text" id="address" class="input-field" name="address" placeholder="Address"><br>
                    <span id="three"></span>
                </div>
                <div class="reg-input">
                    <label for="">Phone Number</label>
                    <input type="text" id="phone" class="input-field" name="phone" placeholder="Your Number"><br>
                    <span id="four"></span>
                </div>
                <div class="reg-input">
                    <label for="">Email</label>
                    <input type="email" id="email" class="input-field" name="email" placeholder="example.@gmail.com"><br>
                    <span id="five"></span>
                </div>
                <div class="reg-input">
                    <label for="">Password</label>
                    <input type="password" id="password" class="input-field" name="password" placeholder="Password"><br>
                    <span id="six"></span>
                </div>
                <div class="reg-input">
                    <label for="">Confirm Password</label>
                    <input type="password" id="cpassword" class="input-field" name="cpassword" placeholder="Confirm Password"><br>
                    <span id="seven"></span>
                </div>
                <div class="reg-input"> 
                    <label >Sign-Up As :</label><br>
                    <select name="role", id="role" class="input-field">
                        <option value="owner">Owner</option>
                        <option value="renter">Tenant</option>
                        <option value="admin" hidden>Admin</option>
                    </select>
                    <span id="err6"></span>
                </div>
                <div class="btn">
                    <input type="submit" value="submit" id="submit" class="reg-btn" name="submit">
                    <button class="reg-btn back"><a href="../Home/home.php"> Back </a> </button>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- <script src="../signup/signup-script.js"></script> -->
</body>
</html>