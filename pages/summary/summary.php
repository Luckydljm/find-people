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
    <h1>Summary</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?pages=dashboard">Home</a></li>
            <li class="breadcrumb-item active">Summary</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Summary Table</h5>
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
                                <th>Title</th>
                                <th>Year</th>
                                <th>Media</th>
                                <th>Publication</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_data = $conn->prepare("SELECT * FROM `summary` WHERE profile = ?");
                                $select_data->execute([$user]);
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
                                                <button class="dropdown-item modal-btn btn-edit-summary"
                                                    id="btnEditSummary" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditSummary"
                                                    data-id="<?= $fetch_data['id_summary']; ?>"
                                                    data-title="<?= $fetch_data['title']; ?>"
                                                    data-media="<?= $fetch_data['media']; ?>"
                                                    data-publication="<?= $fetch_data['publication']; ?>"
                                                    data-link="<?= $fetch_data['link']; ?>"
                                                    data-year="<?= $fetch_data['year']; ?>"><i
                                                        class="bi bi-pencil-fill"></i>Edit</button>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <button class="dropdown-item modal-btn btn-delete-summary"
                                                    id="btnDeleteSummary" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeleteSummary"
                                                    data-id="<?= $fetch_data['id_summary']; ?>"
                                                    data-title="<?= $fetch_data['title']; ?>"><i
                                                        class="bi bi-trash3"></i>Delete</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><b><?= $fetch_data['title']; ?></b></td>
                                <td class="text-center"><?= $fetch_data['year']; ?></td>
                                <td><?= $fetch_data['media']; ?></td>
                                <td><?= $fetch_data['publication']; ?></td>
                                <td><a href="<?= $fetch_data['link']; ?>"><?= $fetch_data['link']; ?></a></td>
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
    <form action="../pages/summary/action.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Summary</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-4">
                            <label for="media" class="form-label">Media</label>
                            <select id="media" class="form-select" name="media" required>
                                <option selected disabled>Choose...</option>
                                <option value="Scopus">Scopus</option>
                                <option value="GScholar">GScholar</option>
                                <option value="WOS">WOS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="publication" class="form-label">Publication</label>
                            <select id="publication" class="form-select" name="publication" required>
                                <option selected disabled>Choose...</option>
                                <option value="Article">Article</option>
                                <option value="Citation">Citation</option>
                                <option value="Cited Document">Cited Document</option>
                                <option value="H-Index">H-Index</option>
                                <option value="i10-Index">i10-Index</option>
                                <option value="G-Index">G-Index</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" required>
                        </div>
                        <div class="col-md-12">
                            <label for="link" class="form-label">Link</label>
                            <textarea name="link" class="form-control" id="link" style="height: 100px"
                                required></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="profile" name="profile" value="<?= $user; ?>">
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

<!-- Edit -->
<div class="modal text-gray-900" id="modalEditSummary" tabindex="-1">
    <form action="../pages/summary/action.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Summary</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control title" id="title" name="title" required>
                        </div>
                        <div class="col-md-4">
                            <label for="media" class="form-label">Media</label>
                            <select id="media" class="form-select media" name="media" required>
                                <option selected disabled>Choose...</option>
                                <option value="Scopus">Scopus</option>
                                <option value="GScholar">GScholar</option>
                                <option value="WOS">WOS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="publication" class="form-label">Publication</label>
                            <select id="publication" class="form-select publication" name="publication" required>
                                <option selected disabled>Choose...</option>
                                <option value="Article">Article</option>
                                <option value="Citation">Citation</option>
                                <option value="Cited Document">Cited Document</option>
                                <option value="H-Index">H-Index</option>
                                <option value="i10-Index">i10-Index</option>
                                <option value="G-Index">G-Index</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control year" id="year" name="year" required>
                        </div>
                        <div class="col-md-12">
                            <label for="link" class="form-label">Link</label>
                            <textarea name="link" class="form-control link" id="link" style="height: 100px"
                                required></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="id_summary" name="id_summary">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="update">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete -->
<div class="modal text-gray-900" id="modalDeleteSummary" tabindex="-1">
    <form action="../pages/summary/action.php" method="POST" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Summary</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <b class="title"></b>?</p>

                </div>
                <input class=" id_summary" type="hidden" name="id_summary">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>