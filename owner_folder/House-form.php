<?php
include('../connect.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('location:../Home/home.php');
    exit();
}

$owner = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email='$owner'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$id = $row['id'];

$errors = [];

if (isset($_POST['submit'])) {
    // Files
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $document = $_FILES['document']['name'];
    $tempdoc = $_FILES['document']['tmp_name'];

    // Fields
    $location = trim($_POST['location']);
    $latitude = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);
    $area = trim($_POST['area']);
    $talla = trim($_POST['talla']);
    $roomNum = trim($_POST['roomNum']);
    $facilities = trim($_POST['facilities']);
    $more = trim($_POST['more']);
    $availability = "available";
    $admin_status = "pending...";

    // File paths
    $folder = 'C:\\xampp\\htdocs\\Houes_Project\\image\\' . $image;
    $doc_folder = 'C:\\xampp\\htdocs\\Houes_Project\\document\\' . $document;

    // Regex patterns
    $alphaRegex = '/^[a-zA-Z\s]+$/';
    $numericRegex = '/^\d+$/';
    $latLngRegex = '/^-?\d+(\.\d+)?$/';
    $areaRegex = '/^\d+(m|km)$/';
    $facilityRegex = '/^[a-zA-Z\s,\/]+$/';
    $allowedImageExt = ['png', 'jpg', 'jpeg'];
    $allowedDocExt = ['pdf', 'doc', 'docx'];

    // Validate image extension
    $imageExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (empty($image)) {
        $errors['image'] = "Image is required.";
    } elseif (!in_array($imageExt, $allowedImageExt)) {
        $errors['image'] = "Only png, jpg, jpeg files are allowed.";
    }

    // Validate address
    if (empty($location)) {
        $errors['location'] = "Address is required.";
    } elseif (!preg_match($alphaRegex, $location)) {
        $errors['location'] = "Address can only include alphabets.";
    }

    // Validate latitude
    if (empty($latitude)) {
        $errors['latitude'] = "Latitude is required.";
    } elseif (!preg_match($latLngRegex, $latitude)) {
        $errors['latitude'] = "Latitude must be a valid number.";
    }

    // Validate longitude
    if (empty($longitude)) {
        $errors['longitude'] = "Longitude is required.";
    } elseif (!preg_match($latLngRegex, $longitude)) {
        $errors['longitude'] = "Longitude must be a valid number.";
    }

    // Validate area
    if (empty($area)) {
        $errors['area'] = "Total area is required.";
    } elseif (!preg_match($areaRegex, $area)) {
        $errors['area'] = "Area must be in format like 12m or 12km.";
    }

    // Validate talla
    if (empty($talla)) {
        $errors['talla'] = "Talla is required.";
    }

    // Validate number of rooms
    if (empty($roomNum)) {
        $errors['roomNum'] = "Number of rooms is required.";
    } elseif (!preg_match($numericRegex, $roomNum)) {
        $errors['roomNum'] = "Number of rooms must be numeric.";
    }

    // Validate facilities
    if (empty($facilities)) {
        $errors['facilities'] = "Facilities are required.";
    } elseif (!preg_match($facilityRegex, $facilities)) {
        $errors['facilities'] = "Facilities can include alphabets, commas, and slashes.";
    }

    // Validate short description
    if (empty($more)) {
        $errors['more'] = "Short description is required.";
    } elseif (!preg_match($facilityRegex, $more)) {
        $errors['more'] = "Description can include alphabets, commas, and slashes.";
    }

    // Validate document extension
    $docExt = strtolower(pathinfo($document, PATHINFO_EXTENSION));
    if (empty($document)) {
        $errors['document'] = "Document is required.";
    } elseif (!in_array($docExt, $allowedDocExt)) {
        $errors['document'] = "Only pdf, doc, docx files are allowed.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $imageUploaded = move_uploaded_file($tempname, $folder);
        $docUploaded = move_uploaded_file($tempdoc, $doc_folder);

        if ($imageUploaded && $docUploaded) {
            $sql = "INSERT INTO house (u_id, image, location, area, talla, roomNum, facilities, more, document, availability, admin_status, latitude, longitude) 
            VALUES ('$id', '$image', '$location', '$area', '$talla', '$roomNum', '$facilities', '$more', '$document', '$availability', '$admin_status', '$latitude', '$longitude')";

            $result = mysqli_query($con, $sql);

            if ($result) {
                echo "<p style='color:green;'>Data Inserted Successfully.</p>";
            } else {
                die(mysqli_error($con));
            }
        } else {
            echo "<p style='color:red;'>Error uploading files.</p>";
        }
    } else {
        // Print all errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
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
            <input type="file" id="image" class="input-field" name="image"><br>
            <span class="error"><?php echo $errors['image'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="location">Address</label>
            <input type="text" id="location" class="input-field" name="location" placeholder="Location"><br>
            <span class="error"><?php echo $errors['location'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="latitude">Latitude</label>
            <input type="text" id="latitude" class="input-field" name="latitude" placeholder="e.g., 37.7749"><br>
            <span class="error"><?php echo $errors['latitude'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="longitude">Longitude</label>
            <input type="text" id="longitude" class="input-field" name="longitude" placeholder="e.g., -122.4194"><br>
            <span class="error"><?php echo $errors['longitude'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="area">Total Area</label>
            <input type="text" id="area" class="input-field" name="area" placeholder="Area"><br>
            <span class="error"><?php echo $errors['area'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="talla">Talla</label>
            <input type="text" id="talla" class="input-field" name="talla" placeholder="Talla"><br>
            <span class="error"><?php echo $errors['talla'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="roomNum">Number of Rooms</label>
            <input type="text" id="roomNum" class="input-field" name="roomNum" placeholder="Enter number of rooms"><br>
            <span class="error"><?php echo $errors['roomNum'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="facilities">Facilities</label>
            <input type="text" id="facilities" class="input-field" name="facilities" placeholder="Parking, Water, etc."><br>
            <span class="error"><?php echo $errors['facilities'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="more">Short Description</label>
            <input type="text" id="more" class="input-field" name="more" placeholder="Additional description"><br>
            <span class="error"><?php echo $errors['more'] ?? ''; ?></span>
        </div>
        <div class="reg-input">
            <label for="document">House Document</label>
            <input type="file" id="document" class="input-field" name="document"><br>
            <span class="error"><?php echo $errors['document'] ?? ''; ?></span>
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
