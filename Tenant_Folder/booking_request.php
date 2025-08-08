<?php
session_start();
include("../connect.php");

if (!isset($_SESSION['id'])) {
    // Redirect to login page if user is not logged in
    header("location:../Home/home.php");
    exit();
}

$tenant_id = $_SESSION['id']; // Tenant's user ID
$house_id = $_GET['requestid']; // House ID from URL

// Check database connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch the owner_id for the house
$owner_sql = "SELECT u_id FROM house WHERE id = ?"; // Make sure house_id exists in the table
$stmt = $con->prepare($owner_sql);

if (!$stmt) {
    die("Query preparation failed: " . $con->error); // Debugging output
}

$stmt->bind_param("i", $house_id);
$stmt->execute();
$stmt->bind_result($owner_id);
$stmt->fetch();

if (!$owner_id) {
    die("Owner not found for this house.");
}

$stmt->close();

// Check if a request already exists for this house by the same tenant
$check_sql = "SELECT * FROM booking_request WHERE tenant_id = ? AND house_id = ?"; // Ensure 'house_id' exists in booking_request table
$stmt = $con->prepare($check_sql);

if (!$stmt) {
    die("Query preparation failed: " . $con->error); // Debugging output
}

$stmt->bind_param("ii", $tenant_id, $house_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   echo "<script>alert('You have already requested this house.'); window.location.href='house-detail.php?detailid=$house_id';</script>";
    exit();
}

// Insert new booking request
$insert_sql = "INSERT INTO booking_request (house_id, tenant_id, owner_id, status) VALUES (?, ?, ?, 'pending')";
$stmt = $con->prepare($insert_sql);

if (!$stmt) {
    die("Query preparation failed: " . $con->error); // Debugging output
}

$stmt->bind_param("iii", $house_id, $tenant_id, $owner_id);

if ($stmt->execute()) {
    echo "<script>alert('Booking request sent successfully!'); window.location.href='house-detail.php?detailid=$house_id';</script>";

} else {
    echo "<script>alert('Failed to send request. Please try again.'); window.location.href='house-detail.php?detailid=$house_id';</script>";

}

$stmt->close();
$con->close();
?>
