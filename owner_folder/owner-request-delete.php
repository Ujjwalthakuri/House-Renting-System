<?php
session_start();
include("../connect.php");

if (!isset($_SESSION['id'])) {
    header('Location: ../Home/home.php');
    exit();
}

if (isset($_GET['deleteid'])) {
    $deleteId = (int)$_GET['deleteid'];

    // Optionally, verify that the booking request belongs to this owner
    $ownerId = $_SESSION['id'];
    $checkSql = "SELECT id FROM booking_request WHERE id = $deleteId AND owner_id = $ownerId";
    $checkResult = mysqli_query($con, $checkSql);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        // Delete the booking request
        $deleteSql = "DELETE FROM booking_request WHERE id = $deleteId";
        if (mysqli_query($con, $deleteSql)) {
            // Successfully deleted
            header("Location: owner-request.php?msg=Rejected+successfully");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
    } else {
        echo "Invalid request or you do not have permission to delete this booking request.";
    }
} else {
    echo "No booking request specified to delete.";
}
?>
