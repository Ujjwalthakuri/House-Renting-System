<?php
include('../connect.php');

$errors = []; // To collect error messages

if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['role'];
    $status = "pending...";

    // Regex patterns
    $numberRegex = '/\d/';
    $alphabetRegex = '/[a-zA-Z]/';
    $regexStart = '/^(?!98|97)\d+$/';
    $emailRegex = '/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/';

    // Validate First Name
    if (empty($fname)) {
        $errors['fname'] = "First Name is required.";
    } elseif (preg_match($numberRegex, $fname)) {
        $errors['fname'] = "Numbers not allowed in First Name.";
    }

    // Validate Last Name
    if (empty($lname)) {
        $errors['lname'] = "Last Name is required.";
    } elseif (preg_match($numberRegex, $lname)) {
        $errors['lname'] = "Numbers not allowed in Last Name.";
    }

    // Validate Address
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    } elseif (preg_match($numberRegex, $address)) {
        $errors['address'] = "Numbers not allowed in Address.";
    } elseif (strlen($address) <= 5) {
        $errors['address'] = "Address must contain more than 5 characters.";
    }

    // Validate Phone Number
    if (empty($phone)) {
        $errors['phone'] = "Phone Number is required.";
    } elseif (preg_match($alphabetRegex, $phone)) {
        $errors['phone'] = "Alphabet not allowed in Phone Number.";
    } elseif (preg_match($regexStart, $phone)) {
        $errors['phone'] = "Phone Number must start with 98 or 97.";
    } elseif (strlen($phone) != 10) {
        $errors['phone'] = "Phone Number must be 10 digits long.";
    }

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!preg_match($emailRegex, $email)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) <= 4) {
        $errors['password'] = "Minimum password length is 5 characters.";
    } elseif (!preg_match($alphabetRegex, $password)) {
        $errors['password'] = "Password must contain at least one letter.";
    } elseif (!preg_match($numberRegex, $password)) {
        $errors['password'] = "Password must contain at least one number.";
    }

    // Validate Confirm Password
    if (empty($cpassword)) {
        $errors['cpassword'] = "Please confirm your password.";
    } elseif ($password !== $cpassword) {
        $errors['cpassword'] = "Passwords do not match.";
    }

    // Check if email already exists
    $emailCheck = "SELECT * FROM user WHERE email='$email'";
    $emailCheck_check = mysqli_query($con, $emailCheck);
    if(mysqli_num_rows($emailCheck_check) > 0){
        $errors['email'] = "Email already exists.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO user (fname, lname, address, phone, email, password, status, role) 
                VALUES('$fname', '$lname', '$address', '$phone', '$email', '$password', '$status', '$role')";
        $result = mysqli_query($con, $sql);
        if($result){
            echo "<p style='color:green;'>Registration successful!</p>";
        } else {
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
                    <span id="one"><?php echo $errors['fname'] ?? ''; ?></span>
                </div>
                <div class="reg-input">
                    <label for="">Last Name</label>
                    <input type="text" id="lname" class="input-field" name="lname" placeholder="Last Name"><br>
                    <span id="one"><?php echo $errors['lname'] ?? ''; ?></span>

                </div>
                <div class="reg-input">
                    <label for="">Address</label>
                    <input type="text" id="address" class="input-field" name="address" placeholder="Address"><br>
                    <span class="error"><?php echo $errors['address'] ?? ''; ?></span>
                </div>
                <div class="reg-input">
                    <label for="">Phone Number</label>
                    <input type="text" id="phone" class="input-field" name="phone" placeholder="Your Number"><br>
                    <span class="error"><?php echo $errors['phone'] ?? ''; ?></span>
                </div>
                <div class="reg-input">
                    <label for="">Email</label>
                    <input type="email" id="email" class="input-field" name="email" placeholder="example.@gmail.com"><br>
                    <span class="error"><?php echo $errors['email'] ?? ''; ?></span>
                </div>
                <div class="reg-input">
                    <label for="">Password</label>
                    <input type="password" id="password" class="input-field" name="password" placeholder="Password"><br>
                    <span class="error"><?php echo $errors['password'] ?? ''; ?></span>
                </div>
                <div class="reg-input">
                    <label for="">Confirm Password</label>
                    <input type="password" id="cpassword" class="input-field" name="cpassword" placeholder="Confirm Password"><br>
                    <span class="error"><?php echo $errors['cpassword'] ?? ''; ?></span>
                </div>
                <div class="reg-input"> 
                    <label >Sign-Up As :</label><br>
                    <select name="role", id="role" class="input-field">
                        <option value="owner">Owner</option>
                        <option value="renter">Tenant</option>
                        <option value="admin" hidden>Admin</option>
                    </select>
                    <span class="error"><?php echo $errors['role'] ?? ''; ?></span>
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