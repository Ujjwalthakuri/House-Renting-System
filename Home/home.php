
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Renting System</title>
    <!-- css-link -->
     <link rel="stylesheet" href="../Home/style.css">
     <!-- fontswesome-link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="head">
        <a href="#" class="logo">UR</a>

        <nav>
        <div class="search">
            <input type="text" class="search-input" placeholder="Search House">
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>

            <ul class="head-right">
                <li><a href="#">Home</a> </li>
                <!-- <li><a href="#">About</a> </li> -->
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

    <!-- home page started -->
    <section class="homepage">
        <div class="videos">
            <video src="../videos/back-clip.mp4" loop autoplay muted class="background-clip"> 
            </video>
        </div>
        <div class="content">
            <h1>We Provide Houses For Rent</h1>
            <h3><a href="house.php">Explore House</a> </h3>
        </div>
    </section>
    

    <!-- js-link -->
     <script src="../Home/script.js"></script>
</body>
</html>