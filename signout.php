<?php
session_start();

session_unset();
session_destroy();
header('Location:../Houes_Project/Home/home.php');

?>