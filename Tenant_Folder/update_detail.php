<?php
session_start();
include("../connect.php");

if (!isset($_SESSION['id'])) {
    header('location:../Home/home.php');
    exit();
}

$id = $_SESSION['id']; // logged-in user id

$sql = "SELECT * FROM user WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Details</title>
    <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="house-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<section class="house-detail">
    <h1>Your Details</h1>
    <?php
    if (mysqli_num_rows($result) == 0) {
        echo "<p>No User found.</p>";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="house-info">
                <div class="house-description">
                    <p>First Name: <?php echo $row['fname']; ?></p>
                    <p>Last Name: <?php echo $row['lname']; ?></p>
                    <p>Permanent Address: <?php echo $row['address']; ?></p>
                    <p>Phone Number: <?php echo $row['phone']; ?></p>
                    <p>Email: <?php echo $row['email']; ?></p>
                    <button class="book"> 
                            <a href="../profile_edit.php?requestid=<?php echo $row['id']; ?>">Edit Your Profile</a> 
                        </button>
                </div>
            </div>
            <?php
        }
    }
    ?>
</section>

<!-- js-link-HomeFolder -->
<script src="Home/script.js"></script>
</body>
</html>
