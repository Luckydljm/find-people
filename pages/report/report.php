<div class="pagetitle">
    <h1>Laporan Curah Hujan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?pages=dashboard">Home</a></li>
            <li class="breadcrumb-item active">Laporan Curah Hujan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Filter Laporan</h5>
            <!-- Filter Laporan Form -->
            <form class="row" action="" method="post">
                <div class="col-md-4">
                    <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                </div>
                <div class="col-md-4">
                    <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                    <a type="button" class="btn btn-danger" name="reset" href="?pages=report">Reset</a>
                </div>
            </form><!-- End Filter Laporan Form -->

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Laporan Curah Hujan</h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped text-gray-900 nowrap" id="example"
                        style="width:100%;font-size:14px">
                        <thead>
                            <tr>
                                <th style="width: 10%;">Id Sensor</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Nilai (mm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['filter'])){
                                    $tgl_mulai = $_POST['tgl_mulai'];
                                    $tgl_mulai = filter_var($tgl_mulai, FILTER_SANITIZE_STRING);
                                    $tgl_akhir = $_POST['tgl_akhir'];
                                    $tgl_akhir = filter_var($tgl_akhir, FILTER_SANITIZE_STRING);
                            
                                    $select_data = $conn->prepare("SELECT * FROM `deteksi_curah_hujan` ORDER BY tanggal ASC");
                                    $select_data->execute();
                                    if($select_data->rowCount() > 0){
                                        while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                                            $tanggal = date('Y-m-d', strtotime($fetch_data['tanggal']));
                                            $jam = date('H:i:s', strtotime($fetch_data['tanggal']));
                                            if($tgl_mulai <= $tanggal && $tgl_akhir >= $tanggal){
                            ?>
                            <tr>
                                <td><?= $fetch_data['id_sensor']; ?></td>
                                <td><?= $tanggal; ?></td>
                                <td><?= $jam; ?></td>
                                <td><b><?= $fetch_data['nilai']; ?></b></td>
                            </tr>
                            <?php }}}} else { 
                                $select_data = $conn->prepare("SELECT * FROM `deteksi_curah_hujan` ORDER BY tanggal ASC");
                                $select_data->execute([]);
                                if($select_data->rowCount() > 0){
                                    while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                                        $tanggal = date('Y-m-d', strtotime($fetch_data['tanggal']));
                                        $jam = date('H:i:s', strtotime($fetch_data['tanggal']));
                            ?>
                            <tr>
                                <td><?= $fetch_data['id_sensor']; ?></td>
                                <td><?= $tanggal; ?></td>
                                <td><?= $jam; ?></td>
                                <td><b><?= $fetch_data['nilai']; ?></b></td>
                            </tr>
                            <?php }}} ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>