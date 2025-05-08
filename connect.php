<?php
    $con = new mysqli("localhost", "root", "", "property");
    
    if(!$con){
        echo "DataBase connected sucessful";
    }
?>