<?php 
include 'config/connect.php';
session_start();

if(isset($_POST['submit'])){

    // Hashing Akun
    $username = md5($_POST['username']);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND password = ?");
    $select_user->execute([$username, $password]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
            $_SESSION['username']  = $row['username'];
            $_SESSION['id']  = $row['id'];
            $_SESSION['sukses'] = "Welcome to FindPeople Dashboard!";
            setcookie('id', $row['id'], time() + 60*60*24*30, '/');
            header('location:layouts/template.php?pages=dashboard');
     }else{
        $_SESSION['gagal'] = "Incorrect Username or Password!";
        header('location:login.php');
     }
 
 }

?>