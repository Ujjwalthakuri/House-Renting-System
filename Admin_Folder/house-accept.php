<?php
include("../connect.php");

if(isset($_GET['accepteid'])){
    $id = $_GET ['accepteid'];
    

    $sql = "UPDATE house SET admin_status = 'accept' WHERE admin_status = 'pending...' AND id=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: admin-house.php?deleted=1");
        exit();
    }else{
         echo "Failed to delete house with ID: $id";
    }
}
?>