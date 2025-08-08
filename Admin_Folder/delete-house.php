<?php
include("../connect.php");

// Check if deleteid is set and is a number
if (isset($_GET['deleteid']) && is_numeric($_GET['deleteid'])) {
    $id = (int)$_GET['deleteid'];

    // Prepare the delete query
    $sql = "DELETE FROM house WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        // Successfully deleted
        header("Location: admin-house.php?msg=House deleted successfully");
        exit();
    } else {
        // Deletion failed
        header("Location: admin-house.php?error=Could not delete house");
        exit();
    }
} else {
    // Invalid or missing id
    header("Location: admin-house.php?error=Invalid house id");
    exit();
}
?>
