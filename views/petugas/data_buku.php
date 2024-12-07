<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
    header("Location: ./error-403.php");
}

$res = getDataEksemplar();
$review = getDataReview();
$books = getDataBooks();
$genres = getDataGenre();

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
                                    data-target="#AddBookModal">
                                    Tambah Buku
                                </button>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover1">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Penulis</th>
                                            <th>No ISBN</th>
                                            <th>Tahun Terbit</th>
                                            <th>Penerbit</th>
                                            <th>Foto Buku</th>
                                            <th>Jumlah Eksemplar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($books as $book) {
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $book['judul'] ?></td>
                                                <td><?= $book['penulis'] ?></td>
                                                <td><?= $book['ISBN'] ?></td>
                                                <td><?= $book['tahun_terbit'] ?></td>
                                                <td><?= $book['penerbit'] ?></td>
                                                <td>
                                                    <!-- Menampilkan foto buku -->
                                                    <img src="<?= $book['foto_buku'] ?>" alt="<?= $book['judul'] ?>"
                                                        width="50" height="75">
                                                </td>
                                                <td><?= $book['jumlah_eksemplar'] ?></td>
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


                <li><a href="#">Data Eksemplar</a>
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
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Eksemplar</th>
                                            <th>Judul Buku</th>
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
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover3">
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


</body>
<!-- The Modal -->
<div class="modal fade" id="AddBookModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="forms-sample" method="POST" action="input_buku.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Judul Buku -->
                    <div class="form-group">
                        <label for="Judul">Judul Buku <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="judul" id="Judul" placeholder="Masukkan Judul Buku" value=""
                            required>
                    </div>

                    <!-- Penulis -->
                    <div class="form-group">
                        <label for="Penulis">Penulis <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="penulis" id="Penulis" placeholder="Masukkan Penulis" value=""
                            required>
                    </div>

                    <!-- Penerbit -->
                    <div class="form-group">
                        <label for="Penerbit">Penerbit <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="penerbit" id="Penerbit" placeholder="Masukkan Penerbit" value=""
                            required>
                    </div>

                    <!-- No ISBN -->
                    <div class="form-group">
                        <label for="ISBN">No ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="ISBN" placeholder="Masukkan No ISBN" value="-">
                    </div>

                    <!-- Tahun Terbit -->
                    <div class="form-group">
                        <label for="TahunTerbit">Tahun Terbit <small class="text-danger">*</small></label>
                        <input type="number" class="form-control" name="tahun_terbit" id="TahunTerbit" placeholder="Masukkan Tahun Terbit"
                            value="" required>
                    </div>

                    <label>Jenis Buku <small class="text-danger">*</small></label><br>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_buku" id="PaketPelajaran"
                                        value="Paket Pelajaran" checked required>
                                    Paket Pelajaran
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_buku"
                                        id="NonPaketPelajaran" value="Non Paket Pelajaran" required>
                                    Non Paket Pelajaran
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi Rak -->
                    <div class="form-group">
                        <label for="LokasiRak">Lokasi Rak <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="lokasi_rak" id="LokasiRak" placeholder="Masukkan Lokasi Rak"
                            value="" required>
                    </div>

                    <!-- Foto Buku -->
                    <div class="form-group">
                        <label>Upload Foto Buku</label>
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input" id="uploadImage"
                                accept="image/*">
                            <label class="custom-file-label" for="uploadImage">Pilih file...</label>
                        </div>
                        <div class="mt-3">
                            <img id="previewImage" src="#" alt="Pratinjau Gambar" class="img-fluid rounded"
                                style="display: none; max-height: 200px;">
                        </div>
                    </div>

                    <!-- Sinopsis -->
                    <div class="form-group">
                        <label for="Sinopsis">Sinopsis <small class="text-danger">*</small></label>
                        <textarea class="form-control" name="sinopsis" id="Sinopsis" rows="3" placeholder="Masukkan Sinopsis"
                            required></textarea>
                    </div>

                    <!-- Genre -->
                    <label>Genre</label><br>
                    <div class="form-group">
                        <div class="row">
                            <?php
                            
                            $counter = 0; // Variabel penghitung untuk jumlah checkbox
                            $colCounter = 0; // Penghitung kolom
                            
                            // Iterasi untuk setiap genre
                            foreach ($genres as $genre) {
                                // Setiap 4 checkbox, buat kolom baru
                                if ($counter % 4 == 0) {
                                    if ($colCounter > 0) {
                                        echo '</div>';
                                        echo '</div>'; // Tutup kolom sebelumnya
                                    }
                                    echo '<div class="col-md-4"><div class="form-group">'; // Buka kolom baru
                                    $colCounter++;
                                }
                                // Cetak checkbox untuk genre
                                echo '<div class="form-check form-check-success">';
                                echo '<label class="form-check-label">';
                                echo '<input type="checkbox" class="form-check-input" name="genre[]" value="' . $genre['id_genre'] . '">';
                                echo $genre['nama_genre'];
                                echo '</label>';
                                echo '</div>';

                                $counter++;
                            }

                            // Menutup kolom terakhir jika perlu
                            if ($colCounter > 0) {
                                echo '</div></div>'; // Tutup kolom terakhir
                            }
                            ?>
                        </div>
                    </div>


                    <!-- Jumlah Eksemplar -->
                    <div class="form-group">
                        <label for="JumlahEksemplar">Jumlah Eksemplar <small class="text-danger">*</small></label>
                        <input type="number" class="form-control" name="jumlah_eksemplar" id="JumlahEksemplar"
                            placeholder="Masukkan Jumlah Eksemplar" min="1" value="" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>


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

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover1').DataTable(); // ID From dataTable with Hover
        $('#dataTableHover2').DataTable();
        $('#dataTableHover3').DataTable(); // ID From dataTable with Hover
    });
</script>

</html>