<?php
session_start();
include '../config/connect.php';
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  $_SESSION['error'] = "Silahkan Login!";
  header('location:../login.php');
}

$user = $_SESSION['id'];
$type = $_SESSION['type'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Find People Website</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- icons -->
    <link href="../assets/img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Datatable -->
    <link href="../assets/vendor/DataTables/datatables.min.css" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="" />
                <span class="d-none d-lg-block">FindPeople</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <?php
                            if ($type == "Admin"){
                        ?>
                        <img src="../assets/img/9.png" alt="Profile" class="rounded-circle" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Admin</h6>
                            <p class="text-muted"><?= $type; ?></p>
                        </li>
                        <?php }else{ 
                            $select_data = $conn->prepare("SELECT * FROM `profile` WHERE akun = ?");
                            $select_data->execute([$user]);
                            if($select_data->rowCount() > 0){
                                while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                                    $photo = $fetch_data['foto'];
                                    $nama = $fetch_data['nama'];
                                    if(!empty($foto)){
                        ?>
                        <img src="../uploaded_img/<?= $fetch_data['foto']; ?>" alt="Profile" class="rounded-circle" />
                        <?php }else{ ?>
                        <img src="../assets/img/9.png" alt="Profile" class="rounded-circle" />
                        <?php } ?>
                        <?php if(!empty($nama)){ ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $fetch_data['nama']; ?></span>
                        <?php }else{ ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2">Authors</span>
                        <?php } ?>
                        </a>
                        <!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <?php if(!empty($nama)){ ?>
                                <h6><?= $fetch_data['nama']; ?></h6>
                                <?php }else{ ?>
                                <h6>Authors</h6>
                                <?php } ?>
                                <p class="text-muted"><?= $type; ?></p>
                            </li>
                            <?php }}} ?>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                        <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
    <!-- End Sidebar-->

    <!-- ======= Main ======= -->
    <main id="main" class="main">
        <?php include '../function.php'; ?>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>FindPeople</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Created by <a href="#">Nanda Putri Julika</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Datatable & Jquery -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/DataTables/datatables.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script>
    // Datatable
    $(document).ready(function() {
        $('#example').DataTable({
            stateSave: true,
            scrollX: true,
            lengthMenu: [
                [10, 15, 20, -1],
                ['10', '15', '20', 'All'],
            ],
        });
    });
    $.fn.DataTable.ext.pager.numbers_length = 3;
    </script>
</body>

</html>