<?php 
    include 'config/connect.php';
    session_start();
    $name = $_SESSION['name'];
    $access = $_SESSION['access'];
    $success = $_SESSION['success'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Find People Website</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Logo web -->
    <link href="assets/img/logo.png" rel="icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="" />
                <span class="d-none d-lg-block">FindPeople</span>
            </a>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item pe-3">
                    <a href="regist.php"><b>Registration</b></a>
                </li>
                <li class="nav-item pe-3">
                    <a href="login.php"><b>Login</b></a>
                </li>
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <main id="horizontal-menu" class="menu">
        <div class="container">
            <?php
            if (isset($_SESSION['success'])) {
            ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <?= $_SESSION['success']; ?> <i>"<?= $_SESSION['name']; ?>"</i>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['success']);
            }
            ?>
            <?php
                if ($access == "Authors"){
            ?>
            <section class="section">
                <?php 
                    $select_data = $conn->prepare("SELECT * FROM `profile` WHERE nama LIKE '%{$name}%' AND type = ?");
                    $select_data->execute([$access]);
                    if($select_data->rowCount() > 0){
                        while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                            $photo = $fetch_data['foto'];
                            $id = $fetch_data['akun'];
                ?>
                <div class="card mb-3 mx-auto" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <?php 
                            if(!empty($photo)){
                            ?>
                            <img src="uploaded_img/<?= $fetch_data['foto']; ?>" class="img-fluid rounded-start"
                                alt="...">
                            <?php }else{ ?>
                            <img src="assets/img/9.png" class="img-fluid rounded-start" alt="...">
                            <?php } ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><a
                                        href="detail.php?get_id=<?= $fetch_data['id_profile']; ?>"><?= $fetch_data['nama']; ?></a>
                                </h5>
                                <p class="card-text"><i class="bi bi-geo-alt-fill"></i> <?= $fetch_data['institusi']; ?>
                                </p>
                                <p class="card-text"><i class="bi bi-person-bounding-box"></i>
                                    <?= $fetch_data['jurusan']; ?></p>
                                <p class="card-text"><i class="bi bi-person-fill"></i> ID:
                                    <?= $fetch_data['id_profile']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-speedometer2"></i> <b>Metrics</b></li>
                        <?php
                            $select_scopus = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'H-Index' AND profile = ?");
                            $select_scopus->execute([$id]);
                            $total_scopus =  $select_scopus->rowCount();

                            $select_wos = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'H-Index' AND profile = ?");
                            $select_wos->execute([$id]);
                            $total_wos =  $select_wos->rowCount();
                            
                            $select_gscholar = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'H-Index' AND profile = ?");
                            $select_gscholar->execute([$id]);
                            $total_gscholar =  $select_gscholar->rowCount();
                        ?>
                        <li class="list-group-item">Scopus H-index : <?= $total_scopus; ?></li>
                        <li class="list-group-item">Wos H-index : <?= $total_wos; ?></li>
                        <li class="list-group-item">Google Scholar H-index : <?= $total_gscholar; ?></li>
                    </ul>
                </div>
                <?php }} ?>
            </section>
            <?php }else{ ?>
            <section class="section">
                <?php 
                    $select_data = $conn->prepare("SELECT * FROM `institution` WHERE institution LIKE '%{$name}%' AND type = ?");
                    $select_data->execute([$access]);
                    if($select_data->rowCount() > 0){
                        while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                            $photo = $fetch_data['logo'];
                ?>
                <div class="card mb-3 mx-auto" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <?php 
                            if(!empty($photo)){
                            ?>
                            <img src="uploaded_img/<?= $fetch_data['logo']; ?>" class="img-fluid rounded-start"
                                alt="...">
                            <?php }else{ ?>
                            <img src="assets/img/9.png" class="img-fluid rounded-start" alt="...">
                            <?php } ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#"><?= $fetch_data['institution']; ?></a></h5>
                                <p class="card-text"><i class="bi bi-geo-alt-fill"></i> <?= $fetch_data['alamat']; ?>
                                </p>
                                <p class="card-text"><i class="bi bi-person-bounding-box"></i>
                                    Total Prodi: <?= $fetch_data['department']; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">Description:</h5>
                                <p class="card-text"><?= $fetch_data['deskripsi']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </section>
            <?php } ?>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="horizontal-footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>FindPeople</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Nanda Putri Julika</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>