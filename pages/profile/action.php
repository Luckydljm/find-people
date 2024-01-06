<?php 
include '../../config/connect.php';
session_start();

 //   Edit
 if(isset($_POST['submit'])){

    $id_profile = $_POST['id_profile'];
    $id_profile = filter_var($id_profile, FILTER_SANITIZE_STRING);
    $nama = $_POST['nama'];
    $nama = filter_var($nama, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $tentang = $_POST['tentang'];
    $tentang = filter_var($tentang, FILTER_SANITIZE_STRING);
    $institusi = $_POST['institusi'];
    $institusi = filter_var($institusi, FILTER_SANITIZE_STRING);
    $jurusan = $_POST['jurusan'];
    $jurusan = filter_var($jurusan, FILTER_SANITIZE_STRING);
    

    $update_dep = $conn->prepare("UPDATE `profile` SET nama = ?, email = ?, tentang = ?, institusi = ?, jurusan = ? WHERE id_profile = ?");
    $update_dep->execute([$nama, $email, $tentang, $institusi, $jurusan, $id_profile]);

      $old_foto = $_POST['old_foto'];
      $old_foto = filter_var($old_foto, FILTER_SANITIZE_STRING);
      $foto = $_FILES['foto']['name'];
      $foto = filter_var($foto, FILTER_SANITIZE_STRING);
      $ext = pathinfo($foto, PATHINFO_EXTENSION);
      $rename = unique_id().'.'.$ext;
      $foto_size = $_FILES['foto']['size'];
      $foto_tmp_name = $_FILES['foto']['tmp_name'];
      $foto_folder = '../../uploaded_img/'.$rename;
   
      if(!empty($foto)){
         $update_foto = $conn->prepare("UPDATE `profile` SET foto = ? WHERE id_profile = ?");
            $update_foto->execute([$rename, $id_profile]);
            move_uploaded_file($foto_tmp_name, $foto_folder);
            if($old_foto != '' AND $old_foto != $rename){
               unlink('../../uploaded_img/'.$old_foto);
            }
      }
 
    $_SESSION['update'] = "Profile updated!";
    header('location:../../layouts/template.php?pages=profile');
 
 } 


?>