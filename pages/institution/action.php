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

 //   Delete
 if(isset($_POST['delete'])){

    $delete_id = $_POST['id_institution'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_institution = $conn->prepare("SELECT * FROM `institution` WHERE id_institution = ? LIMIT 1");
    $verify_institution->execute([$delete_id]);

    if($verify_institution->rowCount() > 0){
        
    $delete_logo = $conn->prepare("SELECT * FROM `institution` WHERE id_institution = ? LIMIT 1");
    $delete_logo->execute([$delete_id]);
    $fetch_thumb = $delete_logo->fetch(PDO::FETCH_ASSOC);
    unlink('../../uploaded_img/'.$fetch_thumb['logo']);
    $delete_institution = $conn->prepare("DELETE FROM `institution` WHERE id_institution = ?");
    $delete_institution->execute([$delete_id]);
    $_SESSION['success'] = "Data deleted!";
    header('location:../../layouts/template.php?pages=institution');
    
    }else{
        $_SESSION['fail'] = "Data not found!";
        header('location:../../layouts/template.php?pages=institution');
    }
}


?>