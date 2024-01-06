<div class="pagetitle">
    <h1>Dashboard</h1>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <?php
    if (isset($_SESSION['sukses'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hallo <?php echo $_SESSION['nama']; ?>!</strong> <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['sukses']);
    }
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Curah Hujan</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>