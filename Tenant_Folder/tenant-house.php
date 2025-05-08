<?php
session_start();
include("../connect.php");

if (!isset($_SESSION['id'])) {
    header('location:../Home/home.php');
    exit();
}

// Get the search term from the URL (if available)
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Default query to fetch available houses
$sql = "SELECT * FROM house WHERE admin_status='accept' AND availability='available'";

// If a search term is provided, filter the houses by address or price
if ($search_term) {
    $sql .= " AND (location LIKE '%$search_term%' OR price LIKE '%$search_term%')";
}

$sql .= " ORDER BY id DESC"; // Optional: Sort by most recent house first

$results = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Renting System</title>
    <link rel="stylesheet" href="../Tenant_Folder/tenant_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
<div class="container">
    <aside class="sidebar">
        <a href="#" class="logo">UR</a>
        <ul class="nav-links">
            <li><a href="tenant-home.php"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="tenant-booking.php"><i class="fa-solid fa-calendar-check"></i> Booking</a></li>
            <li><a href="tenant-house.php"><i class="fa-solid fa-building"></i> Houses</a></li>
            <li><a href="tenant-nearest-house.php" class="active"><i class="fa-solid fa-building"></i> Nearest</a></li>
        </ul>
        <div class="sidebar-footer">
        <a href="update_detail.php?detailid=$tenant_id"><i class="fa fa-user"></i> Your Detail</a>
            <a href="../signout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
        </div>
    </aside>

    <main class="main-content">
        <section class="search-section">
            <form action="tenant-house.php" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search by Address or Price..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </section>

        <section class="rent-list">
            <h1 class="heading">Available Houses</h1>
            <div class="box-container">
                <?php
                if ($results) {
                    // Check if there are any results
                    if (mysqli_num_rows($results) > 0) {
                        while ($result = mysqli_fetch_assoc($results)) {
                            ?>
                            <div class="room_box">
                                <img src="../image/<?php echo $result['image']; ?>" alt="Room Image">
                                <p><strong>Address:</strong> <?php echo $result['location']; ?></p>
                                <p><strong>Monthly Price:</strong> ₹<?php echo $result['price']; ?></p>
                                <button class="view"> 
                                    <a href="house-detail.php?detailid=<?php echo $result["id"]; ?>"><i class="fa-solid fa-eye"></i> View Detail</a>
                                </button>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No houses found based on your search.</p>";
                    }
                }
                ?>
            </div>
        </section>
    </main>
</div>

<!-- js-link-HomeFolder -->
<script src="../Home/script.js"></script>
</body>
</html>
