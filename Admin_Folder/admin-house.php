<?php
    include("../connect.php");
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
     <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Admin_Folder/admin-style.css">
    <link rel="stylesheet" href="../Home/styleHouse.css">
    <!-- fontswesome-link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="admin-container">
    
    <!-- Sidebar (reuse the one from admin-home.php) -->
    <aside class="sidebar">
      <div class="logo">UR</div>
      <ul class="nav-links">
        <li><a href="admin-home.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="admin-user.php"><i class="fa fa-users"></i> Users</a></li>
        <li><a href="admin-house.php"><i class="fa fa-building"></i> Houses</a></li>
        <li><a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </aside>
        
    <main class="main-content">
    <div id="pending-house" class="table-container">
    <section class="rent-list">
            <h1 class="heading"> Pending Houses</h1>
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
                <!-- <th class="table-head">Booked_status</th> -->
                <th class="table-head">Admin_status</th>
                <th class="table-head">Operation</th>
            </tr>
            </thead>
            <tbody>
           
            <?php

                $sql = "select * from house where admin_status='pending...'";
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
                        $more=$row['more'];
                        $document=$row['document'];
                        // $status=$row['status'];
                        $admin_status=$row['admin_status'];
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
                         
                        <td>$admin_status</td>
                        <td>
                            <button class='acc-del-btn'><a href='house-accept.php?accepteid=$id'>Accept</a></button> 
                            <button class='acc-del-btn'><a href='../delete.php?deleteid=$id' >Reject</a> </button> 
                        </td>
                        </tr>"; 
                        }
                        }
            ?>
            </tbody>
            </table>
        </div>


        <!-- Total Houses -->
        <div id="total-house" class="table-container">
    <section class="rent-list">
            <h1 class="heading"> Total Houses</h1>
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
                <!-- <th class="table-head">Booked_status</th> -->
                <th class="table-head">Admin_status</th>
                <th class="table-head">Operation</th>
            </tr>
            </thead>
            <tbody>
           
            <?php

                $sql = "select * from house where admin_status='accept' ";
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
                        $more=$row['more'];
                        $document=$row['document'];
                        // $status=$row['status'];
                        $admin_status=$row['admin_status'];
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
                         
                        <td>$admin_status</td>
                        <td>
                            
                            <button class='acc-del-btn'><a href='../delete.php?deleteid=$id' >Delet</a> </button> 
                        </td>
                        </tr>"; 
                        }
                        }
            ?>
            </tbody>
            </table>
        </div>
    
    <!-- Booked / Rented House -->
    <div id="booked-house" class="table-container">
    <section class="rent-list">
            <h1 class="heading"> Booked Houses</h1>
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
                <!-- <th class="table-head">Booked_status</th> -->
                <th class="table-head">Admin_status</th>
                <th class="table-head">Operation</th>
            </tr>
            </thead>
            <tbody>
           
            <?php

                $sql = "select * from house status='booked'";
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
                        $more=$row['more'];
                        $document=$row['document'];
                        // $status=$row['status'];
                        $admin_status=$row['admin_status'];
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
                         
                        <td>$admin_status</td>
                        <td>
                            <button class='acc-del-btn'><a href='house-accept.php?accepteid=$id'>Accept</a></button> 
                            <button class='acc-del-btn'><a href='../delete.php?deleteid=$id' >Reject</a> </button> 
                        </td>
                        </tr>"; 
                        }
                        }
            ?>
            </tbody>
            </table>
        </div>

        <!-- Not Booked House -->

        <div id="remaining-house" class="table-container">
    <section class="rent-list">
            <h1 class="heading"> Houses Remaining To Be Booked</h1>
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
                <!-- <th class="table-head">Booked_status</th> -->
                <th class="table-head">Admin_status</th>
                <th class="table-head">Operation</th>
            </tr>
            </thead>
            <tbody>
           
            <?php

                $sql = "select * from house where status='pending'";
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
                        $more=$row['more'];
                        $document=$row['document'];
                        // $status=$row['status'];
                        $admin_status=$row['admin_status'];
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
                         
                        <td>$admin_status</td>
                        <td>
                            <button class='acc-del-btn'><a href='house-accept.php?accepteid=$id'>Accept</a></button> 
                            <button class='acc-del-btn'><a href='../delete.php?deleteid=$id' >Reject</a> </button> 
                        </td>
                        </tr>"; 
                        }
                        }
            ?>
            </tbody>
            </table>
        </div>
        </main>

</div>

        <!-- js-link-HomeFolder -->
    <script src="../Home/script.js"></script>
    </body>
    </html>