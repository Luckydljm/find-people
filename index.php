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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fs-1"><b>FindPeople</b></h5>
                        <p class="card-text">The "FindPeople" application is a search information platform that
                            enables
                            users to discover relevant data about someone simply by entering their name. With an
                            intuitive and user-friendly interface, the application utilizes reliable data sources to
                            present information such as addresses, phone numbers, and social media profiles
                            associated
                            with the searched name. Security and user privacy are prioritized in the development of
                            this
                            application, ensuring that only publicly available information is accessible. "FindPeople"
                            aids users in quickly and efficiently searching and confirming information about
                            someone.
                        </p>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <form class="row" action="" method="post">
                            <div class="col-md-12 mt-4">
                                <input type="text" class="form-control" name="name" placeholder="Search...">
                            </div>
                            <div class="col-md-10 mt-2">
                                <select id="type" name="type"
                                    class="form-select bg-primary-subtle text-emphasis-primary">
                                    <option selected value="Author">Author</option>
                                    <option value="Affiliation">Affiliation</option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-2">
                                <button type="submit" class="btn border w-75" name="search"><i
                                        class="bi bi-search"></i></button>
                                <a type="button" class="btn border" href="index.php"><i class="bi bi-x-lg"></i></a>
                            </div>
                        </form>
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