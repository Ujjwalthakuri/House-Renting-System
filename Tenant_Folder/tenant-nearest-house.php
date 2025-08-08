<?php
session_start();
include('../connect.php');

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
    <title>Nearest Houses</title>
    <link rel="stylesheet" href="../Tenant_Folder/tenant_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <a href="update_detail.php?detailid=<?php echo $_SESSION['id']; ?>"><i class="fa fa-user"></i> Your Detail</a>
            <a href="../signout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
        </div>
    </aside>

    <main class="main-content">
        <section class="rent-list">
            <h1 class="heading">Nearest Houses to You</h1>

            <?php
            function haversineDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371)
            {
                $lat1 = deg2rad($lat1);
                $lon1 = deg2rad($lon1);
                $lat2 = deg2rad($lat2);
                $lon2 = deg2rad($lon2);

                $latDelta = $lat2 - $lat1;
                $lonDelta = $lon2 - $lon1;
            
                $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($lat1) * cos($lat2) * pow(sin($lonDelta / 2), 2)));
                return $angle * $earthRadius;
            }
            
            if (isset($_GET['lat']) && isset($_GET['lon'])) {
                $tenant_lat = $_GET['lat'];
                $tenant_lon = $_GET['lon'];

       $sql = "SELECT * FROM house WHERE admin_status='accept' AND availability='available'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $houses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate distance in PHP
        $distance = haversineDistance($tenant_lat, $tenant_lon, $row['latitude'], $row['longitude']);
        if ($distance < 50) { // Only include if within 50 km
            $row['distance'] = $distance;
            $houses[] = $row;
        }
    }

    // Sort by distance 
    usort($houses, function ($a, $b) {
        return $a['distance'] <=> $b['distance'];
    });

    // Limit to 10 results
    $houses = array_slice($houses, 0, 10);

    if (!empty($houses)) {
        echo "<div class='box-container'>";
        foreach ($houses as $row) {
            echo "<div class='room_box'>";
            echo "<a href='house-detail.php?detailid=" . $row['id'] . "'>";
            echo "<img src='../image/" . $row['image'] . "' alt='House Image'>";
            echo "</a>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
            echo "<p><strong>Distance:</strong> " . round($row['distance'], 2) . " km</p>";
            echo "<p><strong>Monthly Price:</strong> " . htmlspecialchars($row['area']) . "</p>";

            $house_lat = $row['latitude'];
            $house_lon = $row['longitude'];
            $map_url = "https://www.google.com/maps/dir/?api=1&origin=$tenant_lat,$tenant_lon&destination=$house_lat,$house_lon";
            echo "<a href='$map_url' target='_blank' class='map-btn'><i class='fa-solid fa-map'></i> View Map</a> <br>";
            echo "<a href='house-detail.php?detailid=" . $row['id'] . "'><i class='fa-solid fa-eye'></i>View Detail</a>";

            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No available houses found within 50 km radius.</p>";
    }
}

            } else {
                echo "<p>Fetching your location...</p>";
            }
            ?>
        </section>
    </main>
</div>

<script>
window.onload = function() {
    if (navigator.geolocation && !window.location.search.includes('lat=')) {
        navigator.geolocation.watchPosition(function(position) {
            console.log("Location fetched: ", position.coords);
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            window.location.href = "tenant-nearest-house.php?lat=" + lat + "&lon=" + lon;
        }, function(error) {
            console.error("Geolocation error: ", error);
            alert("Location access denied or unavailable.");
        });
    }
};
</script>
</body>
</html>
