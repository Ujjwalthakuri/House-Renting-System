<?php
include('../connect.php');
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../Home/home.php");
    exit();
}

// Initialize variables
$roomNum = $facilities = $more = $talla = $price = $image = "";
$errors = [];

// Get house ID from GET parameter
if (isset($_GET['updateid'])) {
    $house_id = (int)$_GET['updateid'];

    $sql = "SELECT * FROM house WHERE id = $house_id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die("House not found.");
    }

    // Pre-fill form values
    $roomNum = $row['roomNum'];
    $facilities = $row['facilities'];
    $more = $row['more'];
    $talla = $row['talla'];
    $price = $row['price'];  // ⬅️ Added
    $image = $row['image'];
} else {
    die("No house ID provided.");
}

// Handle form submission
if (isset($_POST['update'])) {
    $roomNum = trim($_POST['roomNum']);
    $facilities = trim($_POST['facilities']);
    $more = trim($_POST['more']);
    $talla = trim($_POST['talla']);
    $price = trim($_POST['price']);  // ⬅️ Added

    // Validation
    if (empty($roomNum) || !preg_match('/^\d+$/', $roomNum)) {
        $errors['roomNum'] = "Number of rooms must be numeric.";
    }
    if (empty($facilities)) {
        $errors['facilities'] = "Facilities are required.";
    }
    if (empty($more)) {
        $errors['more'] = "Short description is required.";
    }
    if (empty($talla)) {
        $errors['talla'] = "Talla is required.";
    }
    if (empty($price) || !preg_match('/^\d+$/', $price)) {
        $errors['price'] = "Price must be a number.";
    }

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $allowedImageExt = ['png', 'jpg', 'jpeg', 'gif'];
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($imageExt, $allowedImageExt)) {
            $errors['image'] = "Only png, jpg, jpeg, gif files are allowed.";
        } else {
            $newImageName = uniqid('house_', true) . '.' . $imageExt;
            $uploadPath = "../image/" . $newImageName;
        }
    } else {
        $newImageName = $image;
    }

    // If no errors, update database
    if (empty($errors)) {
        if (isset($imageTmpName) && !empty($imageTmpName)) {
            if (!move_uploaded_file($imageTmpName, $uploadPath)) {
                $errors['image'] = "Failed to upload new image.";
            }
        }

        if (empty($errors)) {
            $sql = "UPDATE house 
                    SET roomNum='$roomNum', facilities='$facilities', more='$more', talla='$talla', price='$price', image='$newImageName' 
                    WHERE id=$house_id";

            $result = mysqli_query($con, $sql);

            if ($result) {
                header("Location: owner-house.php");
                exit();
            } else {
                die("Update failed: " . mysqli_error($con));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Update House</title>
    <link rel="stylesheet" href="../owner_folder/owner_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
<div class="admin-container">
    <div class="admin-sidebar">
        <h2 class="logo">UR</h2>
        <ul class="sidebar-menu">
            <li><a href="owner-home.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="owner-request.php"><i class="fa fa-envelope"></i> Request</a></li>
            <li><a href="House-form.php"><i class="fa fa-plus"></i> Add House</a></li>
            <li><a href="owner-house.php" class="active"><i class="fa fa-building"></i> Houses</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="../signout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="admin-content">
        <div class="signup">
            <h1 class="reg-su">Update House Info</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="reg-detail">

                    <div class="reg-input">
                        <label for="image">Image</label><br>
                        <img src="../image/<?php echo htmlspecialchars($image); ?>" style="width:150px; height:auto; margin-bottom:10px;" />
                        <input type="file" name="image" id="image" class="input-field" />
                        <span class="error"><?php echo $errors['image'] ?? ''; ?></span>
                    </div>

                    <div class="reg-input">
                        <label for="roomNum">Number of Rooms</label>
                        <input type="text" name="roomNum" id="roomNum" class="input-field" value="<?php echo htmlspecialchars($roomNum); ?>" />
                        <span class="error"><?php echo $errors['roomNum'] ?? ''; ?></span>
                    </div>

                    <div class="reg-input">
                        <label for="facilities">Facilities</label>
                        <input type="text" name="facilities" id="facilities" class="input-field" value="<?php echo htmlspecialchars($facilities); ?>" />
                        <span class="error"><?php echo $errors['facilities'] ?? ''; ?></span>
                    </div>

                    <div class="reg-input">
                        <label for="more">Short Description</label>
                        <input type="text" name="more" id="more" class="input-field" value="<?php echo htmlspecialchars($more); ?>" />
                        <span class="error"><?php echo $errors['more'] ?? ''; ?></span>
                    </div>

                    <div class="reg-input">
                        <label for="talla">Talla</label>
                        <input type="text" name="talla" id="talla" class="input-field" value="<?php echo htmlspecialchars($talla); ?>" />
                        <span class="error"><?php echo $errors['talla'] ?? ''; ?></span>
                    </div>

                    <div class="reg-input">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="input-field" value="<?php echo htmlspecialchars($price); ?>" />
                        <span class="error"><?php echo $errors['price'] ?? ''; ?></span>
                    </div>

                    <div class="btn">
                        <input type="submit" value="Update" class="reg-btn" name="update" />
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
