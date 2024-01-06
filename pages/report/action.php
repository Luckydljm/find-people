<?php
include 'config/connect.php';
session_start();

    if(isset($_POST['cetak'])){
        $tgl_mulai = $_POST['tgl_mulai'];
        $tgl_mulai = filter_var($tgl_mulai, FILTER_SANITIZE_STRING);
        $tgl_akhir = $_POST['tgl_akhir'];
        $tgl_akhir = filter_var($tgl_akhir, FILTER_SANITIZE_STRING);
        $jam_mulai = $_POST['jam_mulai'];
        $jam_mulai = filter_var($jam_mulai, FILTER_SANITIZE_STRING);
        $jam_akhir = $_POST['jam_akhir'];
        $jam_akhir = filter_var($jam_akhir, FILTER_SANITIZE_STRING);

        $_SESSION['tgl_mulai']  = $tgl_mulai;
        $_SESSION['tgl_akhir']  = $tgl_akhir;
        $_SESSION['jam_mulai']  = $jam_mulai;
        $_SESSION['jam_akhir']  = $jam_akhir;

        header('location:../../cetak.php');
    }
?>