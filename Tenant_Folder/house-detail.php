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
<!-- <header class="head">
    <a href="#" class="logo">UR</a>
    <nav>
        <div class="search">
            <input type="text" class="search-input" placeholder="Search House">
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </nav>
</header> -->

<section class="house-detail">
    <h1>House Details</h1>
    <?php
    if (isset($_GET['detailid'])) {
        $id = $_GET['detailid'];

        $sql = "SELECT * FROM house WHERE admin_status='accept' AND id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No houses found with admin accept status.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="house-info">
                    <img src="../image/<?php echo $row['image']; ?>" alt='Room Image'>
                    <div class="house-description">
                        <p>Address: <?php echo $row['location']; ?></p>
                        <p>Total Area: <?php echo $row['area']; ?></p>
                        <p>Talla: <?php echo $row['talla']; ?></p>
                        <p>Number of Rooms: <?php echo $row['roomNum']; ?></p>
                        <p>Major Facilities: <?php echo $row['facilities']; ?></p>
                        <p>Short Description: <?php echo $row['more']; ?></p>
                        <p class="price">Monthly Price: <?php echo $row['price']; ?></p>
                        <button class="book"> 
                            <a href="booking_request.php?requestid=<?php echo $row['id']; ?>">BOOK NOW</a> 
                        </button>
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
