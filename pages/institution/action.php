<?php 
include '../../config/connect.php';
session_start();

 //   Status
 if(isset($_POST['submit'])){

    $institution = $_POST['institution'];
    $institution = filter_var($institution, FILTER_SANITIZE_STRING);
    $alamat = $_POST['alamat'];
    $alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
    $department = $_POST['department'];
    $department = filter_var($department, FILTER_SANITIZE_STRING);
    $deskripsi = $_POST['deskripsi'];
    $deskripsi = filter_var($deskripsi, FILTER_SANITIZE_STRING);

    $logo = $_FILES['logo']['name'];
    $logo = filter_var($logo, FILTER_SANITIZE_STRING);
    $ext = pathinfo($logo, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $logo_size = $_FILES['logo']['size'];
    $logo_tmp_name = $_FILES['logo']['tmp_name'];
    $logo_folder = '../../uploaded_img/'.$rename;

    $select_ins = $conn->prepare("SELECT * FROM `institution` WHERE institution = ?");
    $select_ins->execute([$institution]);
    
    if($select_ins->rowCount() > 0){
        $_SESSION['fail'] = "Institutions are registered!";
        header('location:../../layouts/template.php?pages=institution');
    }else{
        $add_institution = $conn->prepare("INSERT INTO `institution`(institution, alamat, department, deskripsi, logo) VALUES(?,?,?,?,?)");
        $add_institution->execute([$institution, $alamat, $department, $deskripsi, $rename]);

        move_uploaded_file($logo_tmp_name, $logo_folder);
    
        $_SESSION['success'] = "Institution added!";
        header('location:../../layouts/template.php?pages=institution');
    }
 
 } 

 //   Edit
 if(isset($_POST['update'])){

    $institution = $_POST['institution'];
    $institution = filter_var($institution, FILTER_SANITIZE_STRING);
    $alamat = $_POST['alamat'];
    $alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
    $department = $_POST['department'];
    $department = filter_var($department, FILTER_SANITIZE_STRING);
    $deskripsi = $_POST['deskripsi'];
    $deskripsi = filter_var($deskripsi, FILTER_SANITIZE_STRING);
    $malam = $_POST['malam'];
    $malam = filter_var($malam, FILTER_SANITIZE_STRING);
    

    $update_dep = $conn->prepare("UPDATE `institution` SET alamat = ?, department = ?, deskripsi = ?, malam = ? WHERE institution = ?");
    $update_dep->execute([$alamat, $department, $deskripsi, $malam, $institution]);
 
    $_SESSION['update'] = "institution berhasil diupdate!";
    header('location:../../layouts/template.php?pages=institution');
 
 } 


?>