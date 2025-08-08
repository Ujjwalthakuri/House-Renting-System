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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Owner Request Page</title>
    <link rel="stylesheet" href="../owner_folder/owner_style.css" />
    <!-- fontawesome-link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
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

        .acc-del-btn {
            margin: 3px;
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
        }

        .acc-del-btn a {
            text-decoration: none;
            color: inherit;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="admin-container">
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2 class="logo">UR</h2>
        <ul class="sidebar-menu">
            <li><a href="owner-home.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="owner-request.php" class="active"><i class="fa fa-envelope"></i> Request</a></li>
            <li><a href="House-form.php"><i class="fa fa-plus"></i> Add House</a></li>
            <li><a href="owner-house.php"><i class="fa fa-building"></i> Houses</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="update_detail.php?detailid=<?php echo $_SESSION['id']; ?>"><i class="fa fa-user"></i> Your Detail</a>
            <a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <section class="rent-list">
            <h1 class="heading">Tenant's Request</h1>

            <table class="table">
                <thead>
                <tr>
                    <th class="table-head">S.no</th>
                    <th class="table-head">House Image</th>
                    <th class="table-head">Tenant-name</th>
                    <th class="table-head">Status</th>
                    <th class="table-head">Operation</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $sql = "SELECT booking_request.id, booking_request.house_id, house.image AS house_image, 
                               user.id AS tenant_id, user.fname AS tenant_name, booking_request.status
                        FROM booking_request
                        INNER JOIN user ON user.id = booking_request.tenant_id
                        INNER JOIN house ON house.id = booking_request.house_id
                        WHERE booking_request.owner_id = '" . $_SESSION['id'] . "' AND booking_request.status = 'pending'";

                $result = mysqli_query($con, $sql);

                if (!$result) {
                    echo "<tr><td colspan='5'>SQL error: " . mysqli_error($con) . "</td></tr>";
                } else if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='5'>No requests found.</td></tr>";
                } else {
                    $serial = 1; // Serial number counter
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $house_id = $row['house_id'];
                        $house_image = $row['house_image'];
                        $tenant_id = $row['tenant_id'];
                        $tenant_name = $row['tenant_name'];
                        $status = $row['status'];
                        ?>
                        <tr>
                            <td><?php echo $serial++; ?></td>
                            <td class="pic">
                                <a href="house-detail.php?detailid=<?php echo $house_id; ?>">
                                    <img src="../image/<?php echo $house_image; ?>" alt="House Image" style="width:100px; height:100px;">
                                </a>
                            </td>
                            <td><a href="tenant-detail.php?detailid=<?php echo $tenant_id; ?>"> <?php echo $tenant_name; ?> </a></td>
                            <td><?php echo $status; ?></td>
                            <td>
    <button class="acc-del-btn" onclick="confirmAccept(<?php echo $id; ?>)">Accept</button>
    <button class="acc-del-btn" onclick="confirmReject(<?php echo $id; ?>)">Reject</button>
</td>


                        </tr>
                        <?php
                    }
                }
                ?>

                </tbody>
            </table>
        </section>
    </div>
</div>

<script>
function confirmAccept(id) {
    if (confirm("Are you sure you want to accept this tenant request?")) {
        window.location.href = "owner-accept-tenant.php?accepteid=" + id;
    }
}

function confirmReject(id) {
    if (confirm("Are you sure you want to reject this tenant request?")) {
        window.location.href = "owner-request-delete.php?deleteid=" + id;
    }
}

</script>

<!-- js-link-HomeFolder -->
<script src="../Home/script.js"></script>
</body>
</html>
