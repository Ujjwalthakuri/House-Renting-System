<?php
session_start();
include("../connect.php");

if (!isset($_SESSION['id'])) {
    header('location:../Home/home.php');
    exit();
}
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
    <h1>Owner Details</h1>
    <?php
    if (isset($_GET['detailid'])) {
        $id = $_GET['detailid'];
        // echo $id;

        $sql = "SELECT * FROM user WHERE status='accept' AND id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No Tenant found with admin accept status.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="house-info">
                    <!-- <img src="../image/<?php echo $row['image']; ?>" alt='Room Image'> -->
                    <div class="house-description">
                        <p>First Name: <?php echo $row['fname']; ?></p>
                        <p>Last Name: <?php echo $row['lname']; ?></p>
                        <p>Permanent Address: <?php echo $row['address']; ?></p>
                        <p>Phone Number: <?php echo $row['phone']; ?></p>
                        <p>Email: <?php echo $row['email']; ?></p>
                        
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
</section>
<!-- js-link-HomeFolder -->
<script src="Home/script.js"></script>
</body>
</html>
