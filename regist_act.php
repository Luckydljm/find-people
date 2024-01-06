<?php 
include 'config/connect.php';
session_start();

 //   Account
 if(isset($_POST['submit'])){

    $nama = $_POST['nama'];
    $nama = filter_var($nama, FILTER_SANITIZE_STRING);
    $username = md5($_POST['username']);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $add_users = $conn->prepare("INSERT INTO `users`(username, password) VALUES(?,?)");
    $add_users->execute([$username, $password]);
    if($add_users){
      $select_data = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND password = ?");
      $select_data->execute([$username, $password]);
      if($select_data->rowCount() > 0){
          while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
            $id = $fetch_data['id'];
            $add_profile = $conn->prepare("INSERT INTO `profile`(nama, akun) VALUES(?,?)");
            $add_profile->execute([$nama,$id]);
          }
      }
    }

    $_SESSION['sukses'] = "Your account has been successfully created!";
    header('location:login.php');
 
 } 

?>