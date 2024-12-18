<?php

require './include/Pengunjung_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
    header("Location: ./error-403.php");
}
$data = getDataUsers($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Dashboard User</title>

<?php include "./include/css.php"; ?>


</head>

<body>
    <div class="container-scroller">
        <!-- include:navbar.php -->
        <?php
        include "./include/navbar.php";
        ?>

        <div class="container-fluid page-body-wrapper">
            <!-- include -->
            <!-- sidebar_settings.php -->
            <?php
            include "../../include/sidebar_setting.php";
            ?>


            <!-- sidebar.php -->
            <?php
            include "./include/sidebar.php";
            ?>

            <!-- Tampilan main yang diubah tiap file -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">PROFILE</h3>
                                    <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                placeholder="Nama Lengkap" value="<?= $data['nama_pengunjung'] ?>"
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="No_induk">No Induk</label>
                                            <input type="text" class="form-control" id="No_induk" placeholder="No Induk"
                                                value="<?= $data['no_induk'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <input type="text" class="form-control" id="kelas" placeholder="Kelas"
                                                value="<?= $data['kelas'] ?>" disabled>
                                        </div>

                                        <!-- Hidden fields for other data that will not be displayed but submitted -->
                                        <input type="text" name="nama" value="<?= $data['nama_pengunjung'] ?>" hidden>
                                        <input type="text" name="no_induk" value="<?= $data['no_induk'] ?>" hidden>
                                        <input type="text" name="id_user" value="<?= $data['id_user'] ?>" hidden>
                                        <input type="text" name="username" value="<?= $data['username'] ?>" hidden>
                                        <input type="text" name="role" value="<?= $_SESSION['status'] ?>" hidden>
                                        <input type="text" name="tahun_masuk" value="<?= $data['tahun_masuk'] ?>" hidden>
                                        <input type="text" name="kelas" value="<?= $data['kelas_asli'] ?>" hidden>

                                        <div class="form-group">
                                            <label>Upload Foto Profil</label>
                                            <div class="custom-file">
                                                <input type="file" name="berkas" class="custom-file-input"
                                                    id="uploadImage" accept="image/*">
                                                <label class="custom-file-label" for="uploadImage">Pilih file...</label>
                                            </div>
                                            <div class="mt-3">
                                                <img id="previewImage" src="#" alt="Pratinjau Gambar"
                                                    class="img-fluid rounded" style="display: none; max-height: 200px;">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" id="alamat" rows="3"
                                                name="alamat"><?= $data['alamat'] ?></textarea>
                                        </div>

                                        <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Save
                                            Changes</button>
                                        <a href="index.php" class="btn btn-light"
                                            onclick="return confirm('Apakah anda yakin ingin meninggalkan perubahan?')">Close</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- include footer -->
                <?php
                include "../../include/footer.php";
                ?>
            </div>

        </div>

    </div>


    <?php include "./include/js.php"; ?>

    <script>
        // Update label saat file dipilih
        document.querySelector('.custom-file-input').addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name || 'Pilih file...';
            const label = e.target.nextElementSibling;
            label.textContent = fileName;

            // Menampilkan pratinjau gambar jika file adalah gambar
            const preview = document.getElementById('previewImage');
        });
    </script>

    <?php include "./crud/change_profile.php"; ?>
</body>

</html>