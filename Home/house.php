<?php
include('../connect.php'); // Include the connect.php file from the parent folder
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Renting System</title>
    <!-- css-link -->
     <link rel="stylesheet" href="../Home/style.css">
     <!-- css of house.php -->
     <link rel="stylesheet" href="../Home/styleHouse.css">
     <!-- fontswesome-link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="head">
        <a href="home.php" class="logo">UR</a>

        <nav>
        <div class="search">
            <input type="text" class="search-input" placeholder="Search House">
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>

            <ul class="head-right">
                <li><a href="home.php">Home</a> </li>
                <li><a href="#">About</a> </li>
                <li><a href="house.php">Houses</a> </li>
            </ul>
        <!-- </nav> -->
        <div class="login">
            <a href="#"><i class="fa-solid fa-user"></i></a>
            <ul class="login-drop-down">
                <li><a href="../signin/signin.php">Sign In</a></li>
                <li><a href="../signup/signup.php">Sign Up</a></li>
            </ul>
        </div>
    </nav>
    </header>

    <!-- main section start started -->
    
     <!-- body part started -->
     <section class="rent-list">
            <h1 class="heading"> Available Houses</h1>
            <div class="box-container">
            <?php
    
    // $sql = "SELECT * FROM house WHERE admin_status='accept' ORDER BY id DESC"; ////////Added later
    $sql = "SELECT * FROM house WHERE admin_status='accept' AND availability='available' ORDER BY id DESC";

    $results = mysqli_query($con, $sql);
    
    if ($results) {
        while ($result = mysqli_fetch_array($results)) {
            ?>
<div class="room_box">

        <img src="../image/<?php echo $result['image']; ?>" alt='Room Image'>
        <!-- <div class="room_box_info">  -->
    <p>Address: <?php echo $result['location']; ?></p>
    <p>Monthly Price: <?php echo $result['price']; ?></p>
    <!-- <p>Talla: <?php echo $result['talla']; ?></p> -->
    <button class="view">
        <a href="../signin/signin.php">View Detail</a>
    </button>

</div>

            <?php
        };
    };
    ?>
    </div>
          
</section>

        <!-- body part end -->  




    <!-- js-link -->
     <script src="../Home/script.js"></script>
</body>
</html>