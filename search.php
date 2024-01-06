<?php
include 'config/connect.php';
session_start();

    if(isset($_POST['search'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $access = $_POST['access'];
        $access = filter_var($access, FILTER_SANITIZE_STRING);

        $_SESSION['name']  = $name;
        $_SESSION['access']  = $access;
        $_SESSION['success']  = "Results for";

        header('location:show.php');
    }
?>