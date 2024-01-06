<?php 
include '../../config/connect.php';
session_start();

 //   Status
 if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $year = $_POST['year'];
    $year = filter_var($year, FILTER_SANITIZE_STRING);
    $media = $_POST['media'];
    $media = filter_var($media, FILTER_SANITIZE_STRING);
    $publication = $_POST['publication'];
    $publication = filter_var($publication, FILTER_SANITIZE_STRING);
    $link = $_POST['link'];
    $link = filter_var($link, FILTER_SANITIZE_STRING);
    $profile = $_POST['profile'];
    $profile = filter_var($profile, FILTER_SANITIZE_STRING);

    $select_ins = $conn->prepare("SELECT * FROM `summary` WHERE title = ?");
    $select_ins->execute([$title]);
    
    if($select_ins->rowCount() > 0){
        $_SESSION['fail'] = "Summary are registered!";
        header('location:../../layouts/template.php?pages=summary');
    }else{
        $add_summary = $conn->prepare("INSERT INTO `summary`(title, year, media, publication, link, profile) VALUES(?,?,?,?,?,?)");
        $add_summary->execute([$title, $year, $media, $publication, $link, $profile]);
    
        $_SESSION['success'] = "Summary added!";
        header('location:../../layouts/template.php?pages=summary');
    }
 
 } 

  //   Edit
  if(isset($_POST['update'])){

    $id_summary = $_POST['id_summary'];
    $id_summary = filter_var($id_summary, FILTER_SANITIZE_STRING);
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $year = $_POST['year'];
    $year = filter_var($year, FILTER_SANITIZE_STRING);
    $media = $_POST['media'];
    $media = filter_var($media, FILTER_SANITIZE_STRING);
    $publication = $_POST['publication'];
    $publication = filter_var($publication, FILTER_SANITIZE_STRING);
    $link = $_POST['link'];
    $link = filter_var($link, FILTER_SANITIZE_STRING);
    

    $update_summary = $conn->prepare("UPDATE `summary` SET title = ?, year = ?, media = ?, publication = ?, link = ? WHERE id_summary = ?");
    $update_summary->execute([$title, $year, $media, $publication, $link, $id_summary]);
 
    $_SESSION['success'] = "Summary updated!";
    header('location:../../layouts/template.php?pages=summary');
 
 } 

 //   Delete
 if(isset($_POST['delete'])){

    $delete_id = $_POST['id_summary'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_summary = $conn->prepare("SELECT * FROM `summary` WHERE id_summary = ? LIMIT 1");
    $verify_summary->execute([$delete_id]);

    if($verify_summary->rowCount() > 0){
        
    $delete_summary = $conn->prepare("DELETE FROM `summary` WHERE id_summary = ?");
    $delete_summary->execute([$delete_id]);
    $_SESSION['success'] = "Data deleted!";
    header('location:../../layouts/template.php?pages=summary');
    
    }else{
        $_SESSION['fail'] = "Data not found!";
        header('location:../../layouts/template.php?pages=summary');
    }
}


?>