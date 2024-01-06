<?php if (isset($_SESSION['update'])) { ?>
<script>
Swal.fire({
    title: "SUCCESS!",
    text: "<?= $_SESSION['update']; ?>",
    icon: "success"
});
</script>
<?php unset($_SESSION['update']); } ?>
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?pages=dashboard">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <?php 
                    $select_data = $conn->prepare("SELECT * FROM `profile` WHERE akun = ?");
                    $select_data->execute([$user]);
                    if($select_data->rowCount() > 0){
                        while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){
                            $photo = $fetch_data['foto'];
                            if(!empty($photo)){
                    ?>
                    <img src="../uploaded_img/<?= $fetch_data['foto']; ?>" alt="Profile" class="rounded-circle" />
                    <?php }else{ ?>
                    <img src="../assets/img/9.png" alt="Profile" class="rounded-circle" />
                    <?php } ?>
                    <h2><?= $fetch_data['nama']; ?></h2>
                    <h3><?= $type; ?></h3>
                    <?php }} ?>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <?php 
                                $select_profile = $conn->prepare("SELECT * FROM `profile` WHERE akun = ?");
                                $select_profile->execute([$user]);
                                if($select_profile->rowCount() > 0){
                                    while($fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic"><?= $fetch_profile['tentang']; ?></p>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8"><?= $fetch_profile['nama']; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Institution</div>
                                <div class="col-lg-9 col-md-8"><?= $fetch_profile['institusi']; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Department</div>
                                <div class="col-lg-9 col-md-8"><?= $fetch_profile['jurusan']; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?= $fetch_profile['email']; ?></div>
                            </div>
                            <?php }} ?>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form action="../pages/profile/action.php" method="POST" class="modal-form"
                                enctype="multipart/form-data">
                                <?php 
                                    $select_info = $conn->prepare("SELECT * FROM `profile` WHERE akun = ?");
                                    $select_info->execute([$user]);
                                    if($select_info->rowCount() > 0){
                                        while($fetch_info = $select_info->fetch(PDO::FETCH_ASSOC)){
                                            $photo = $fetch_info['foto'];
                                ?>
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <?php 
                                            if(!empty($photo)){ 
                                        ?>
                                        <img src="../uploaded_img/<?= $fetch_info['foto']; ?>" alt="Profile"
                                            class="rounded-circle" />
                                        <?php }else{ ?>
                                        <img src="../assets/img/9.png" alt="Profile">
                                        <?php } ?>
                                        <div class="pt-2">
                                            <input name="foto" type="file" class="form-control" id="foto"
                                                accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama" type="text" class="form-control" id="nama"
                                            value="<?= $fetch_info['nama']; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tentang" class="col-md-4 col-lg-3 col-form-label">About</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea name="tentang" class="form-control" id="tentang"
                                            style="height: 100px"><?= $fetch_info['tentang']; ?></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="institusi" class="col-md-4 col-lg-3 col-form-label">Institution</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select id="institusi" class="form-select" name="institusi">
                                            <option selected value="<?= $fetch_info['institusi']; ?>">
                                                <?= $fetch_info['institusi']; ?></option>
                                            <?php
                                                $select_inst = $conn->prepare("SELECT * FROM `institution`");
                                                $select_inst->execute();
                                                if($select_inst->rowCount() > 0){
                                                    while($fetch_inst = $select_inst->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <option value="<?= $fetch_inst['institution']; ?>">
                                                <?= $fetch_inst['institution']; ?>
                                            </option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jurusan" class="col-md-4 col-lg-3 col-form-label">Department</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="jurusan" type="text" class="form-control" id="email"
                                            value="<?= $fetch_info['jurusan']; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email"
                                            value="<?= $fetch_info['email']; ?>">
                                    </div>
                                </div>
                                <input name="id_profile" type="hidden" class="form-control" id="id_profile"
                                    value="<?= $fetch_info['id_profile']; ?>">
                                <?php }} ?>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
    </div>
</section>