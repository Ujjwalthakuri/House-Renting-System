<?php
include ("connect.php");

if(isset($_GET['accepteid'])){
    $id = $_GET ['accepteid'];
    

    $sql = "UPDATE user SET status = 'accept' WHERE status = 'pending...' AND id=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        // Redirect with success message
        header("Location: Admin_Folder/admin-user.php?deleted=1");
        exit();
    } else {
        echo "Failed to delete user with ID: $id";
    }
}
?>

