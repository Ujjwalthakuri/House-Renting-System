<?php
include("../connect.php");

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM house WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // JavaScript alert + redirect
        echo "<script>
            alert('Delete successful!');
            window.location.href = 'owner-house.php';
        </script>";
    } else {
        echo "<script>
            alert('Delete failed!');
            window.location.href = 'owner-house.php';
        </script>";
    }
}
?>
