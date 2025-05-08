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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../Admin_Folder/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="logo">UR</div>
            <ul class="nav-links">
                <li><a href="admin-home.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="admin-user.php"><i class="fa fa-users"></i> Users</a></li>
                <li><a href="admin-house.php"><i class="fa fa-building"></i> Houses</a></li>
                <li><a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1>Dashboard</h1>
            <div class="cards">
                <?php
                $widgets = [
                    ["title" => "New Requested Users", "sql" => "SELECT * FROM user WHERE status = 'pending...'", "link" => "admin-user.php#pending-user"],
                    ["title" => "Total Users", "sql" => "SELECT * FROM user WHERE status = 'accept'", "link" => "admin-user.php#accept-user"],
                    ["title" => "Total Owners", "sql" => "SELECT * FROM user WHERE status = 'accept' AND role = 'owner'", "link" => "admin-user.php#accept-owner"],
                    ["title" => "Total Tenants", "sql" => "SELECT * FROM user WHERE status = 'accept' AND role = 'renter'", "link" => "admin-user.php#accept-tenant"],
                    ["title" => "Pending Houses", "sql" => "SELECT * FROM house WHERE admin_status = 'pending...'", "link" => "admin-house.php#pending-house"],
                    ["title" => "Accepted Houses", "sql" => "SELECT * FROM house WHERE admin_status = 'accept'", "link" => "admin-house.php#total-house"],
                    ["title" => "Houses on Rent", "sql" => "SELECT * FROM house WHERE admin_status = 'booked'", "link" => "admin-house.php#booked-house"],
                    ["title" => "Remaining Houses", "sql" => "SELECT * FROM house WHERE admin_status = 'pending'", "link" => "admin-house.php#remaining-house"]

                ];

                foreach ($widgets as $widget) {
                    $result = mysqli_query($con, $widget["sql"]);
                
                    if (!$result) {
                        // Debug output (optional: remove in production)
                        echo "<div class='card error'><h3>{$widget['title']}</h3><p>Error: " . mysqli_error($con) . "</p></div>";
                        continue;
                    }
                
                    $count = mysqli_num_rows($result);
                    echo "
                    <div class='card'>
                        <a href='../Admin_Folder/{$widget['link']}'>
                            <h3>{$widget['title']}</h3>
                            <p>" . ($count ? $count : "No Data") . "</p>
                        </a>
                    </div>";
                }
                
                ?>
            </div>
        </main>
    </div>
</body>
</html>
