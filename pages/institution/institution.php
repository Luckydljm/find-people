<!-- Notifikasi -->
<?php if (isset($_SESSION['success'])) { ?>
<script>
Swal.fire({
    title: "SUCCESS!",
    text: "<?= $_SESSION['success']; ?>",
    icon: "success"
});
</script>
<?php unset($_SESSION['success']); } ?>

<?php if (isset($_SESSION['fail'])) { ?>
<script>
Swal.fire({
    title: "FAILED!",
    text: "<?= $_SESSION['fail']; ?>",
    icon: "error"
});
</script>
<?php unset($_SESSION['fail']); } ?>

<div class="pagetitle">
    <h1>Institution</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?pages=dashboard">Home</a></li>
            <li class="breadcrumb-item active">Institution</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Institution Table</h5>
                        <div class="card-title">
                            <button class="btn btn-sm btn-primary modal-btn" data-bs-toggle="modal"
                                data-bs-target="#modalAddData">Add Data</button>
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped text-gray-900" id="example" style="width:100%;font-size:14px">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Logo</th>
                                <th>Institution</th>
                                <th>Department</th>
                                <th>About</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_data = $conn->prepare("SELECT * FROM `institution`");
                                $select_data->execute();
                                if($select_data->rowCount() > 0){
                                    while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" style="font-size: 0.8rem;">
                                            <i class="bi bi-three-dots-vertical" style="font-size: 0.8rem;"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" style="font-size: 0.9rem;">
                                            <li>
                                                <button class="dropdown-item modal-btn btn-delete-ins" id="btnDeleteIns"
                                                    data-bs-toggle="modal" data-bs-target="#modalDeleteIns"
                                                    data-id="<?= $fetch_data['id_institution']; ?>"
                                                    data-institution="<?= $fetch_data['institution']; ?>"><i
                                                        class="bi bi-trash3"></i>Delete</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><img src="../uploaded_img/<?= $fetch_data['logo']; ?>" class="w-75" alt="Logo">
                                </td>
                                <td><b><?= $fetch_data['institution']; ?></b></td>
                                <td class="text-center"><?= $fetch_data['department']; ?></td>
                                <td><?= $fetch_data['deskripsi']; ?></td>
                                <td><?= $fetch_data['alamat']; ?></td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<!-- Tambah Data -->
<div class=" modal text-gray-900" id="modalAddData" tabindex="-1">
    <form action="../pages/institution/action.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Institution</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                        </div>
                        <div class="col-md-6">
                            <label for="institution" class="form-label">Institution Name</label>
                            <input type="text" class="form-control" id="institution" name="institution" required>
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Total Departement</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                        </div>
                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label">About</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" style="height: 100px"
                                required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Address</label>
                            <textarea name="alamat" class="form-control" id="alamat" style="height: 100px"
                                required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete -->
<div class="modal text-gray-900" id="modalDeleteIns" tabindex="-1">
    <form action="../pages/institution/action.php" method="POST" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Institution</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <b class="institution"></b>?</p>

                </div>
                <input class="id_institution" type="hidden" name="id_institution">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>