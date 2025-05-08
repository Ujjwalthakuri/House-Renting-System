<?php
session_start(); // Start the session
include("../connect.php");

// if (!isset($_SESSION['id'])) {
//     // Redirect to login page if session variable is not set
//     header('location:../Home/home.php');
//     exit(); // Stop further execution
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="../owner_folder/owner_style.css">
     <!-- <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Admin_Folder/admin-style.css">
    <link rel="stylesheet" href="../Home/styleHouse.css"> -->
    <!-- fontswesome-link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="admin-container">
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2 class="logo">UR</h2>
        <ul class="sidebar-menu">
            <li><a href="owner-home.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="owner-request.php"><i class="fa fa-envelope"></i> Request</a></li>
            <li><a href="House-form.php"><i class="fa fa-plus"></i> Add House</a></li>
            <li><a href="owner-house.php" class="active"><i class="fa fa-building"></i> Houses</a></li>
        </ul>
        <div class="sidebar-footer">
        <a href="update_detail.php?detailid=$tenant_id"><i class="fa fa-user"></i> Your Detail</a>
            <a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">

        
    <div class="table-container">
    <section class="rent-list">
            <h1 class="heading"> List of Houses</h1>
</section>
            <table class="table">
            <thead>
             <tr>
                <th class="table-head">S.no</th>
                <th class="table-head">Image</th>
                <th class="table-head">Location</th>
                <th class="table-head">Price</th>
               <th class="table-head">Area</th>
                <th class="table-head">Talla</th>
                <th class="table-head">Number of<br> Room</th>
                <th class="table-head">Facilities</th>
                <th class="table-head">Short Description</th>
                <th class="table-head">Document</th>
                <th class="table-head">availability</th>
                <th class="table-head">Operation</th>
                </tr>
            </thead>
            <tbody>
           
            <?php

                $owner = $_SESSION['email'];
                $sql="select * from user where email='$owner'";
                $query=mysqli_query($con, $sql);
                $row=mysqli_fetch_array($query);
                $id=$row['id'];
                // echo "$id";

                $sql = "select * from house where u_id=$id";
                $result = mysqli_query($con, $sql);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $image=$row['image'];
                        $location=$row['location'];
                        $price=$row['price'];
                        $area=$row['area'];
                        $talla=$row['talla'];
                        $roomNum=$row['roomNum'];
                        $facilities=$row['facilities'];
                        $availability=$row['availability'];
                        $more=$row['more'];
                        $document=$row['document'];
                        echo "<tr>
                        <td>$id</td>
                        <td class='pic'><img src='../image/$image' alt='Owner Image'></td>
                        <td>$location</td>
                        <td>$price</td>
                        <td>$area</td>
                        <td>$talla</td>
                        <td>$roomNum</td>
                        <td>$facilities</td>
                        <td>$more</td>
                        <td class='pic'>
                           <a href='../document/$document' download>
                            <img src='../document/$document' alt='Owner Image' />
                            </a>
                        </td>
                        <td>$availability</td>
                         <td>";
    
    // 👉 Check availability
    if (strtolower($availability) == 'available') {
        echo "<button class='acc-del-btn'><a href='#' class='btn-click'>Update</a> </button> 
              <button class='acc-del-btn'><a href='owner-house-delete.php?deleteid=$id'>Delete</a> </button>";
    } else {
        // Leave the Operation column blank
        echo "";
    }
    
echo "</td>
                        </tr>"; 
                        }
                        }
            ?>
            </tbody>
            </table>
        </div>
</div>
        <!-- js-link-HomeFolder -->
    <script src="../Home/script.js"></script>
    </body>
    </html>