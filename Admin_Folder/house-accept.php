<?php
include("../connect.php");

if(isset($_GET['accepteid'])){
    $id = $_GET ['accepteid'];
    

    $sql = "UPDATE house SET admin_status = 'accept' WHERE admin_status = 'pending...' AND id=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "Accept Successful";
    }else{
        echo "(Cannot adsfjkl)";
        echo $id;
    }
}
?>