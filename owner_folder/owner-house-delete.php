<?php
include("../connect.php");
if(isset($_GET['deleteid'])){
    $id = $_GET ['deleteid'];
    

    $sql = "delete from house WHERE id=$id";
    // $sql = "delete from house WHERE id=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "Delete Successful";
    }else{
        echo "(Cannot fjfjdelete)";
        echo $id;
    }
}

?>