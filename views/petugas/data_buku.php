<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
    header("Location: ../login.php");
}

$res = getDataEksemplar();
$review = getDataReview();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perpustakaan SMAN 2 Binjai</title>

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

            <!-- to do list.php -->
            <?php
            include "../../include/to_do_list.php";
            ?>

            <!-- sidebar.php -->
            <?php
            include "./include/sidebar.php";
            ?>

            <!-- Tampilan main yang diubah tiap file -->
            <ul id="nav-tabs">
                <li><a href="#">Data Buku</a>
                    <section style="max-height: 500px; overflow-y: auto;">
                        <div class="card mb-4">
                            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                                <h4 class="m-0 font-weight-bold text-primary">Data Buku</h4>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#bookModal">
                                    Tambah Buku
                                </button>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover1">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>No Induk</th>
                                            <th>Judul Buku</th>
                                            <th>Penulis</th>
                                            <th>Penerbit</th>
                                            <th>No ISBN</th>
                                            <th>Tahun Terbit</th>
                                            <th>Jenis Buku</th>
                                            <th>Lokasi Rak</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($res as $data) {

                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $data['id_eksemplar_buku'] ?></td>
                                                <td><?= $data['judul'] ?></td>
                                                <td><?= $data['penulis'] ?></td>
                                                <td><?= $data['penerbit'] ?></td>
                                                <td><?= $data['ISBN'] ?></td>
                                                <td><?= $data['tahun_terbit'] ?></td>
                                                <td><?= $data['jenis_buku'] ?></td>
                                                <td><?= $data['lokasi_rak'] ?></td>
                                                <td><?= $data['status'] ?></td>
                                                <td>
                                                    <!-- Tombol Hapus -->
                                                    <button type="button"
                                                        class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tombolhapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <!-- Tombol Edit -->
                                                    <button type="button"
                                                        class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tomboledit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </section>
                </li>

                <li><a href="#">Data Review</a>
                    <section style="max-height: 500px; overflow-y: auto;">
                        <div class="card mb-4">
                            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                                <h4 class="m-0 font-weight-bold text-primary">Data Review</h4>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Peminjaman</th>
                                            <th>Judul Buku</th>
                                            <th>Nama</th>
                                            <th>Rating</th>
                                            <th>Komentar</th>
                                            <th>Waktu Ulasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach ($review as $rev) {
                                        ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $rev['id_peminjaman'] ?></td> 
                                                <td><?= $rev['judul'] ?></td> 
                                                <td><?= $rev['nama_user'] ?></td>
                                                <td><?= $rev['rating'] ?></td> 
                                                <td><?= $rev['komentar'] ?></td> 
                                                <td><?= $rev['waktu_ulasan'] ?></td>
                                                <!-- Waktu Ulasan -->
                                                <td>
                                                    <!-- Tombol Hapus -->
                                                    <button type="button"
                                                        class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tombolhapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <!-- Tombol Edit -->
                                                    <button type="button"
                                                        class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tomboledit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </section>
                </li>
            </ul>
        </div>
    </div>

    <?php include "./include/js.php"; ?>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover1').DataTable(); // ID From dataTable with Hover
            $('#dataTableHover2').DataTable(); // ID From dataTable with Hover
        });
    </script>
</body>
<!-- The Modal -->
<div class="modal fade" id="bookModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <label>Judul Buku <small class="text-danger">*</small></label>
                    <input type="text" name="judul" placeholder="Judul Buku" class="form-control" required>
                    <br>
                    <label>Penulis <small class="text-danger">*</small></label>
                    <input type="text" name="penulis" placeholder="Penulis" class="form-control" required>
                    <br>
                    <label>Penerbit <small class="text-danger">*</small></label>
                    <input type="text" name="penerbit" placeholder="Penerbit" class="form-control" required>
                    <br>
                    <label>Tahun Terbit <small class="text-danger">*</small></label>
                    <input type="text" name="tahun_terbit" placeholder="Tahun Terbit" class="form-control" required>
                    <br>
                    <label>Kategori <small class="text-danger">*</small></label>
                    <input type="text" name="kategori" placeholder="Kategori" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewguru">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>