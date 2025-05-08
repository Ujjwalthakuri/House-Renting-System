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
    <title>Owner Home Page</title>
    <link rel="stylesheet" href="../owner_folder/owner_style.css">
    <link rel="stylesheet" href="../owner_folder/tenant_style.css">
    <!-- <link rel="stylesheet" href="../Admin_Folder/admin-style.css">
    <link rel="stylesheet" href="owner-style.css"> NEW style file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2 class="logo">UR</h2>
        <ul class="sidebar-menu">
            <li><a href="owner-home.php" class="active"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="owner-request.php"><i class="fa fa-envelope"></i> Request</a></li>
            <li><a href="House-form.php"><i class="fa fa-plus"></i> Add House</a></li>
            <li><a href="owner-house.php" ><i class="fa fa-building"></i> Houses</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="update_detail.php?detailid=$tenant_id"><i class="fa fa-user"></i> Your Detail</a>
            <!-- <a href='tenant-detail.php?detailid=$tenant_id'> $tenant_name </a> -->
            <a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <div class="header-bar">
            <h1>Your Booked Houses</h1>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>House Image</th>
                        <th>Tenant Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT booking_accepted.id, booking_accepted.house_id, house.image AS house_image, 
                    user.fname AS tenant_name, user.id AS tenant_id
                FROM booking_accepted
                INNER JOIN user ON user.id = booking_accepted.tenant_id
                INNER JOIN house ON house.id = booking_accepted.house_id
                WHERE booking_accepted.owner_id = " . (int)$_SESSION['id'];
        

                    $result = mysqli_query($con, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $house_id = $row['house_id'];
                            $house_image = $row['house_image'];
                            $tenant_name = $row['tenant_name'];
                            $tenant_id = $row['tenant_id'];

                            echo "<tr>
                                    <td>$id</td>
                                    <td>
                                        <a href='house-detail.php?detailid=$house_id'> 
                                    <img src='../image/$house_image' alt='House Image' style='width:100px; height:100px;'>
                                </a>
                                    </td>
                                    <td>  <a href='tenant-detail.php?detailid=$tenant_id'> $tenant_name </a></td>
                                    <td>Accepted</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No bookings found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../Home/script.js"></script>
</body>
</html>
