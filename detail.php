<?php 
    include 'config/connect.php';
    session_start();
    if(isset($_GET['get_id'])){
        $id = $_GET['get_id'];
     }else{
        $id = '';
        header('location:index.php');
     }
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
            <section class="section">
                <div class="row">
                    <div class="col-md-6">
                        <?php 
                    $select_data = $conn->prepare("SELECT * FROM `profile` WHERE id_profile = ?");
                    $select_data->execute([$id]);
                    if($select_data->rowCount() > 0){
                        while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                            $photo = $fetch_data['foto'];
                            $akun = $fetch_data['akun'];
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
                                        <h5 class="card-title mb-0"><a href="#"><?= $fetch_data['nama']; ?></a>
                                        </h5>
                                        <p class="card-text mb-0"><i class="bi bi-geo-alt-fill"></i>
                                            <?= $fetch_data['institusi']; ?>
                                        </p>
                                        <p class="card-text mb-0"><i class="bi bi-person-bounding-box"></i>
                                            <?= $fetch_data['jurusan']; ?></p>
                                        <small class="card-text text-muted"><i class="bi bi-person-fill"></i> ID:
                                            <?= $fetch_data['id_profile']; ?>
                                        </small>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="bi bi-folder-symlink"></i> Articles</h5>
                                        <ul class="list-group list-group-flush">
                                            <?php
                                        $select_summary = $conn->prepare("SELECT * FROM `summary` WHERE profile = ?");
                                        $select_summary->execute([$akun]);
                                        if($select_summary->rowCount() > 0){
                                            while($fetch_summary = $select_summary->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                            <li class="list-group-item">
                                                <a href="<?= $fetch_summary['link']; ?>" target="_blank">
                                                    <h5><?= $fetch_summary['title']; ?></h5>
                                                </a><span class="text-muted">Authors:
                                                    <?= $fetch_data['nama']; ?></span><br><small
                                                    class="text-muted"><?= $fetch_summary['year']; ?></small>
                                            </li>
                                            <?php }} ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3 mx-auto" style="max-width: 540px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">Summary</h5>
                                </div>

                                <!-- Count Data -->
                                <?php
                                    $select_data = $conn->prepare("SELECT * FROM `profile` WHERE id_profile = ?");
                                    $select_data->execute([$id]);
                                    if($select_data->rowCount() > 0){
                                        while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                                            $akun = $fetch_data['akun'];
                                            
                                            // H-Index
                                            $select_scopus1 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'H-Index' AND profile = ?");
                                            $select_scopus1->execute([$akun]);
                                            $total_scopus1 =  $select_scopus1->rowCount();

                                            $select_wos1 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'H-Index' AND profile = ?");
                                            $select_wos1->execute([$akun]);
                                            $total_wos1 =  $select_wos1->rowCount();
                                            
                                            $select_gscholar1 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'H-Index' AND profile = ?");
                                            $select_gscholar1->execute([$akun]);
                                            $total_gscholar1 =  $select_gscholar1->rowCount();

                                            // Article
                                            $select_scopus2 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'Article' AND profile = ?");
                                            $select_scopus2->execute([$akun]);
                                            $total_scopus2 =  $select_scopus2->rowCount();

                                            $select_wos2 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'Article' AND profile = ?");
                                            $select_wos2->execute([$akun]);
                                            $total_wos2 =  $select_wos2->rowCount();
                                            
                                            $select_gscholar2 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'Article' AND profile = ?");
                                            $select_gscholar2->execute([$akun]);
                                            $total_gscholar2 =  $select_gscholar2->rowCount();

                                            // Citation
                                            $select_scopus3 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'Citation' AND profile = ?");
                                            $select_scopus3->execute([$akun]);
                                            $total_scopus3 =  $select_scopus3->rowCount();

                                            $select_wos3 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'Citation' AND profile = ?");
                                            $select_wos3->execute([$akun]);
                                            $total_wos3 =  $select_wos3->rowCount();
                                            
                                            $select_gscholar3 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'Citation' AND profile = ?");
                                            $select_gscholar3->execute([$akun]);
                                            $total_gscholar3 =  $select_gscholar3->rowCount();

                                            // Cited Document
                                            $select_scopus4 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'Cited Document' AND profile = ?");
                                            $select_scopus4->execute([$akun]);
                                            $total_scopus4 =  $select_scopus4->rowCount();

                                            $select_wos4 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'Cited Document' AND profile = ?");
                                            $select_wos4->execute([$akun]);
                                            $total_wos4 =  $select_wos4->rowCount();
                                            
                                            $select_gscholar4 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'Cited Document' AND profile = ?");
                                            $select_gscholar4->execute([$akun]);
                                            $total_gscholar4 =  $select_gscholar4->rowCount();

                                            // i10-Index
                                            $select_scopus5 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'i10-Index' AND profile = ?");
                                            $select_scopus5->execute([$akun]);
                                            $total_scopus5 =  $select_scopus5->rowCount();

                                            $select_wos5 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'i10-Index' AND profile = ?");
                                            $select_wos5->execute([$akun]);
                                            $total_wos5 =  $select_wos5->rowCount();
                                            
                                            $select_gscholar5 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'i10-Index' AND profile = ?");
                                            $select_gscholar5->execute([$akun]);
                                            $total_gscholar5 =  $select_gscholar5->rowCount();

                                            // G-Index
                                            $select_scopus6 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'Scopus' AND publication = 'G-Index' AND profile = ?");
                                            $select_scopus6->execute([$akun]);
                                            $total_scopus6 =  $select_scopus6->rowCount();

                                            $select_wos6 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'WOS' AND publication = 'G-Index' AND profile = ?");
                                            $select_wos6->execute([$akun]);
                                            $total_wos6 =  $select_wos6->rowCount();
                                            
                                            $select_gscholar6 = $conn->prepare("SELECT * FROM `summary` WHERE media = 'GScholar' AND publication = 'G-Index' AND profile = ?");
                                            $select_gscholar6->execute([$akun]);
                                            $total_gscholar6 =  $select_gscholar6->rowCount();
                                        }
                                    }
                                ?>
                                <!-- Table with stripped rows -->
                                <table class="table table-striped text-gray-900 text-center" id="example"
                                    style="width:100%;font-size:14px">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-danger">Scopus</th>
                                            <th class="text-success">GScholar</th>
                                            <th class="text-primary">WOS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Article</td>
                                            <td class="text-danger"><?= $total_scopus2; ?></td>
                                            <td class="text-success"><?= $total_gscholar2; ?></td>
                                            <td class="text-primary"><?= $total_wos2; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Citation</td>
                                            <td class="text-danger"><?= $total_scopus3; ?></td>
                                            <td class="text-success"><?= $total_gscholar3; ?></td>
                                            <td class="text-primary"><?= $total_wos3; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cited Document</td>
                                            <td class="text-danger"><?= $total_scopus4; ?></td>
                                            <td class="text-success"><?= $total_gscholar4; ?></td>
                                            <td class="text-primary"><?= $total_wos4; ?></td>
                                        </tr>
                                        <tr>
                                            <td>H-Index</td>
                                            <td class="text-danger"><?= $total_scopus1; ?></td>
                                            <td class="text-success"><?= $total_gscholar1; ?></td>
                                            <td class="text-primary"><?= $total_wos1; ?></td>
                                        </tr>
                                        <tr>
                                            <td>i10-Index</td>
                                            <td class="text-danger"><?= $total_scopus5; ?></td>
                                            <td class="text-success"><?= $total_gscholar5; ?></td>
                                            <td class="text-primary"><?= $total_wos5; ?></td>
                                        </tr>
                                        <tr>
                                            <td>G-Index</td>
                                            <td class="text-danger"><?= $total_scopus6; ?></td>
                                            <td class="text-success"><?= $total_gscholar6; ?></td>
                                            <td class="text-primary"><?= $total_wos6; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
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