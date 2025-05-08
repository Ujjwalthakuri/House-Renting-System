<?php
session_start();
include("connect.php");

if (!isset($_SESSION['id'])) {
    header('location:Home/home.php');
    exit();
}

// Fetch logged-in user info
$id = $_SESSION['id'];

$sql = "SELECT * FROM user WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "User not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $updateSql = "UPDATE user SET fname=?, lname=?, address=?, phone=?, email=? WHERE id=?";
    $updateStmt = mysqli_prepare($con, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "sssssi", $fname, $lname, $address, $phone, $email, $id);
    $success = mysqli_stmt_execute($updateStmt);

    if ($success) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='owner_folder/update_detail.php';</script>";
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Profile</title>
    <link rel="stylesheet" href="Home/style.css">
    <link rel="stylesheet" href="house-detail.css">
    <link rel="stylesheet" href="profile-edit.css">
</head>
<body>

<section class="house-detail">
    <h1>Edit Your Profile</h1>
    <form method="POST" class="house-info">
        <div class="house-description">
            <p>First Name: <input type="text" name="fname" value="<?php echo htmlspecialchars($row['fname']); ?>" required></p>
            <p>Last Name: <input type="text" name="lname" value="<?php echo htmlspecialchars($row['lname']); ?>" required></p>
            <p>Permanent Address: <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required></p>
            <p>Phone Number: <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required></p>
            <p>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required></p>
            
            <button type="submit" class="book">Save Changes</button>
        </div>
    </form>
</section>

</body>
</html>
