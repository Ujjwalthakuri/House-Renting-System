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
    <link rel="stylesheet" href="admin-style.css">
    <link rel="stylesheet" href="../Home/styleHouse.css">
    <!-- FontAwesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <!-- Pending Users Section -->
    <div class="pending-user" id="pending-user">
        <section class="rent-list">
            <h1 class="heading">List of Pending Users</h1>
        </section>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-head">S.no</th>
                        <th class="table-head">First Name</th>
                        <th class="table-head">Last Name</th>
                        <th class="table-head">Address</th>
                        <th class="table-head">Phone Number</th>
                        <th class="table-head">Email</th>
                        <th class="table-head">Status</th>
                        <th class="table-head">Role</th>
                        <th class="table-head">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM user WHERE status='pending...'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $address = $row['address'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $status = $row['status'];
                            $role = $row['role'];
                            echo "<tr>
                                <td>$id</td>
                                <td>$fname</td>
                                <td>$lname</td>
                                <td>$address</td>
                                <td>$phone</td>
                                <td>$email</td>
                                <td>$status</td>
                                <td>$role</td>
                                <td>
                                    <button class='acc-del-btn'><a href='../accept.php?accepteid=$id'>Accept</a></button>
                                    <button class='acc-del-btn'><a href='../delete.php?deleteid=$id'>Delete</a></button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Accepted Users Section -->
    <div class="accept-user" id="accept-user">
        <section class="rent-list">
            <h1 class="heading">List of Accepted Users</h1>
        </section>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-head">S.no</th>
                        <th class="table-head">First Name</th>
                        <th class="table-head">Last Name</th>
                        <th class="table-head">Address</th>
                        <th class="table-head">Phone Number</th>
                        <th class="table-head">Email</th>
                        <th class="table-head">Status</th>
                        <th class="table-head">Role</th>
                        <th class="table-head">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM user WHERE status='accept'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $address = $row['address'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $status = $row['status'];
                            $role = $row['role'];
                            echo "<tr>
                                <td>$id</td>
                                <td>$fname</td>
                                <td>$lname</td>
                                <td>$address</td>
                                <td>$phone</td>
                                <td>$email</td>
                                <td>$status</td>
                                <td>$role</td>
                                <td>
                                    <button class='acc-del-btn'><a href='../delete.php?deleteid=$id'>Delete</a></button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Accepted owner Section -->
    <div class="accept-user" id="accept-owner">
        <section class="rent-list">
            <h1 class="heading">List of Total Owner</h1>
        </section>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-head">S.no</th>
                        <th class="table-head">First Name</th>
                        <th class="table-head">Last Name</th>
                        <th class="table-head">Address</th>
                        <th class="table-head">Phone Number</th>
                        <th class="table-head">Email</th>
                        <th class="table-head">Status</th>
                        <th class="table-head">Role</th>
                        <th class="table-head">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM user WHERE status='accept' and role='owner'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $address = $row['address'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $status = $row['status'];
                            $role = $row['role'];
                            echo "<tr>
                                <td>$id</td>
                                <td>$fname</td>
                                <td>$lname</td>
                                <td>$address</td>
                                <td>$phone</td>
                                <td>$email</td>
                                <td>$status</td>
                                <td>$role</td>
                                <td>
                                    <button class='acc-del-btn'><a href='../delete.php?deleteid=$id'>Delete</a></button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Accepted tenant Section -->
    <div class="accept-user" id="accept-tenant">
        <section class="rent-list">
            <h1 class="heading">List of Total Tenant</h1>
        </section>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-head">S.no</th>
                        <th class="table-head">First Name</th>
                        <th class="table-head">Last Name</th>
                        <th class="table-head">Address</th>
                        <th class="table-head">Phone Number</th>
                        <th class="table-head">Email</th>
                        <th class="table-head">Status</th>
                        <th class="table-head">Role</th>
                        <th class="table-head">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM user WHERE status='accept' and role='renter'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $address = $row['address'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $status = $row['status'];
                            $role = $row['role'];
                            echo "<tr>
                                <td>$id</td>
                                <td>$fname</td>
                                <td>$lname</td>
                                <td>$address</td>
                                <td>$phone</td>
                                <td>$email</td>
                                <td>$status</td>
                                <td>$role</td>
                                <td>
                                    <button class='acc-del-btn'><a href='../delete.php?deleteid=$id'>Delete</a></button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </main>
    </div>
    <!-- JS Script Link -->
    <script src="../Home/script.js"></script>
</body>
</html>
