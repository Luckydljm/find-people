<?php 
include 'config/connect.php';
session_start();

 //   Account
 if(isset($_POST['submit'])){

    $username = md5($_POST['username']);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $add_users = $conn->prepare("INSERT INTO `users`(username, password) VALUES(?,?)");
    $add_users->execute([$username, $password]);

    $_SESSION['sukses'] = "Your account has been successfully created!";
    header('location:login.php');
 
 } 

?>