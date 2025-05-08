<?php
include('../connect.php'); // Include the connect.php file from the parent folder

session_start();

// Check if session variable is set
if (!isset($_SESSION['id'])) {
    // Redirect to login page if session variable is not set
    header('location:../Home/home.php');
    exit(); // Stop further execution
}

$owner = $_SESSION['email'];
$sql="select * from user where email='$owner'";
$query=mysqli_query($con, $sql);
$row=mysqli_fetch_array($query);
$id=$row['id'];

if(isset($_POST['submit'])){

    // for image
    $image = $_FILES ['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'C:\\xampp\\htdocs\\Houes_Project\\image\\' . $image;

    // location
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $latitude = mysqli_real_escape_string($con, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($con, $_POST['longitude']);
    // location
    $area=$_POST['area'];
    $talla=$_POST['talla'];
    $roomNum=$_POST['roomNum'];
    $facilities=$_POST['facilities']; 
    $more = $_POST['more'];
    $availability = "available";
    $admin_status = "pending...";

    // for document
    $document = $_FILES ['document']['name'];
    $tempdoc = $_FILES['document']['tmp_name'];  
    $doc_folder =  'C:\\xampp\\htdocs\\Houes_Project\\document\\' . $document;

    // Upload both files separately
    $imageUploaded = move_uploaded_file($tempname, $folder);
    $docUploaded = move_uploaded_file($tempdoc, $doc_folder);

    if ($imageUploaded && $docUploaded) {
        $sql = "INSERT INTO house (u_id, image, location, area, talla, roomNum, facilities, more, document, availability, admin_status, latitude, longitude) 
        VALUES ('$id', '$image', '$location', '$area', '$talla', '$roomNum', '$facilities', '$more', '$document', '$availability', '$admin_status', '$latitude', '$longitude')";
        
        $result = mysqli_query($con, $sql);
    
        if ($result) {
            echo "Data Inserted";
        } else {
            die(mysqli_error($con));
        }
    }
    
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Form</title>
    <link rel="stylesheet" href="../owner_folder/owner_style.css">
    <!-- <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Home/owner-style.css">
    <link rel="stylesheet" href="../signup/signup-style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <h2 class="logo">UR</h2>
            <ul class="sidebar-menu">
                <li><a href="owner-home.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="owner-request.php"><i class="fa fa-envelope"></i> Request</a></li>
                <li><a href="House-form.php" class="active"><i class="fa fa-plus"></i> Add House</a></li>
                <li><a href="owner-house.php"><i class="fa fa-building"></i> Houses</a></li>
            </ul>
            <div class="sidebar-footer">
                <a href="update_detail.php?detailid=$tenant_id"><i class="fa fa-user"></i> Your Detail</a>
                <a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <div class="signup">
                <h1 class="reg-su">Add a House</h1>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="reg-detail">
                        <div class="reg-input">
                            <label for="image">Image</label>
                            <input type="file" id="image" class="input-field" name="image" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="location">Address</label>
                            <input type="text" id="location" class="input-field" name="location" placeholder="Location" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="latitude">Latitude</label>
                            <input type="text" id="latitude" class="input-field" name="latitude" placeholder="e.g., 37.7749" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="longitude">Longitude</label>
                            <input type="text" id="longitude" class="input-field" name="longitude" placeholder="e.g., -122.4194" required><br>
                        </div>

                        <div class="reg-input">
                            <label for="area">Total Area</label>
                            <input type="text" id="area" class="input-field" name="area" placeholder="Area" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="talla">Talla</label>
                            <input type="text" id="talla" class="input-field" name="talla" placeholder="Talla" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="roomNum">Number of Rooms</label>
                            <input type="text" id="roomNum" class="input-field" name="roomNum" placeholder="Enter number of rooms" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="facilities">Facilities</label>
                            <input type="text" id="facilities" class="input-field" name="facilities" placeholder="Parking, Water, etc." required><br>
                        </div>
                        <div class="reg-input">
                            <label for="more">Short Description</label>
                            <input type="text" id="more" class="input-field" name="more" placeholder="Additional description" required><br>
                        </div>
                        <div class="reg-input">
                            <label for="document">House Document</label>
                            <input type="file" id="document" class="input-field" name="document" required><br>
                        </div>
                        <div class="btn">
                            <input type="submit" value="Submit" class="reg-btn" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../Home/script.js"></script>
</body>
</html>
