<div class="pagetitle">
    <h1>Dashboard</h1>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <?php
    if (isset($_SESSION['sukses'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hallo <?php echo $_SESSION['type']; ?>!</strong> <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['sukses']);
    }
    ?>

    <!-- Count Data -->
    <?php
        $select_data = $conn->prepare("SELECT * FROM `summary` WHERE profile = ?");
        $select_data->execute([$user]);
        $total_data =  $select_data->rowCount();

        $select_all = $conn->prepare("SELECT * FROM `summary`");
        $select_all->execute();
        $total_all =  $select_all->rowCount();
        
        $select_ins = $conn->prepare("SELECT * FROM `institution`");
        $select_ins->execute();
        $total_ins =  $select_ins->rowCount();
    ?>

    <?php
        if ($type == "Authors"){
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-12 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Total Summary
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-folder-symlink"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $total_data; ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Total Institution
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-buildings"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $total_ins; ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Total Summary
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-folder-symlink"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $total_all; ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</section>