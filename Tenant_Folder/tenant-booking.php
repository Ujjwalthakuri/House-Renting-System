<?php
session_start(); // Start the session
include("../connect.php");

if (!isset($_SESSION['id'])) {
    // Redirect to login page if session variable is not set
    header('location:../Home/home.php');
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Form</title>
    <link rel="stylesheet" href="../Tenant_Folder/tenant_style.css">
    <!-- <link rel="stylesheet" href="../Home/style.css"> -->
    <!-- <link rel="stylesheet" href="../Admin_Folder/admin-style.css"> -->
    <!-- <link rel="stylesheet" href="../Home/styleHouse.css"> -->
    <!-- fontswesome-link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
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
        <!-- <a href="update_detail.php?detailid=$tenant_id"><i class="fa fa-user"></i> Your Detail</a> -->
        <a href="update_detail.php?detailid=<?php echo $_SESSION['id']; ?>"><i class="fa fa-user"></i> Your Detail</a>

            <a href="../signout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
        </div>
    </aside>

    <main class="main-content">
        <section class="rent-list">
            <h1 class="heading">YOUR BOOKED HOUSE</h1>

            <table class="table">
            <thead>
             <tr>
                <th class="table-head">S.no</th>
                <th class="table-head">House Image</th>
                <th class="table-head">Owner-name</th>
                <th class="table-head">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
               $sql = "SELECT booking_request.id, booking_request.house_id, booking_request.owner_id, house.image AS house_image, 
               user.fname AS owner_name, booking_request.status
        FROM booking_request
        INNER JOIN user ON user.id = booking_request.owner_id
        INNER JOIN house ON house.id = booking_request.house_id
        WHERE booking_request.tenant_id = '" . $_SESSION['id'] . "' AND booking_request.status = 'accept'";


               $result = mysqli_query($con, $sql);
               if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $house_id = $row['house_id'];
                    $house_image = $row['house_image'];
                    $owner_name = $row['owner_name'];
                    $status = $row['status'];
                    $owner_id = $row['owner_id'];

                    
                    echo "<tr>
                            <td>$id</td>
                            <td class='pic'>
                                <a href='house-detail.php?detailid=$house_id'> 
                                    <img src='../image/$house_image' alt='House Image' style='width:100px; height:100px;'>
                                </a>
                            </td>
                            <td><a href='tenant-detail.php?detailid=$owner_id'> $owner_name </a> </td>
                            <td>$status</td>
                        </tr>";
                }
               }
            ?>
            </tbody>
            </table>
        </section>
    </main>
</div>

<!-- js-link-HomeFolder -->
<script src="../Home/script.js"></script>
</body>
</html>
