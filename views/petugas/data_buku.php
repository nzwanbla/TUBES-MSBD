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


            <!-- sidebar.php -->
            <?php
            include "./include/sidebar.php";
            ?>

            <!-- Tampilan main yang diubah tiap file -->
            <ul id="nav-tabs">
                <li><a href="#">Data Buku</a>
                    <section style="max-height: 500px; overflow-y: auto;">
                        <div class="card mb-4">
                            <div class="card-header py-4 d-flex justify-content-between align-items-center">
                                <!-- Data Buku di Kiri -->
                                <h4 class="m-0 font-weight-bold text-primary">Data Buku</h4>

                                <!-- Tombol di Kanan -->
                                <div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#AddBookModal">
                                        Tambah Buku
                                    </button>
                                </div>
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
                                            <th>Eksemplar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($books as $book) {
                                            $genreSelected = getIdGenreBook($book['id_buku']); // Misalnya, ini mengembalikan array [6, 11]
                                        
                                            // Gabungkan ID genre menjadi string yang dipisahkan koma
                                            $genreIds = implode(',', $genreSelected); // Hasil: "6,11"
                                        
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
                                                    <button type="button"
                                                        class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
                                                        onclick="window.location.href='./detail_katalog.php?id=<?= $book['id_buku'] ?>';">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                    <!-- Tombol Edit dengan data-genre yang di-encode menjadi JSON -->
                                                    <button type="button"
                                                        class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tombolEdit"
                                                        data-id="<?= $book['id_buku'] ?>" data-judul="<?= $book['judul'] ?>"
                                                        data-penulis="<?= $book['penulis'] ?>"
                                                        data-isbn="<?= $book['ISBN'] ?>"
                                                        data-tahun_terbit="<?= $book['tahun_terbit'] ?>"
                                                        data-penerbit="<?= $book['penerbit'] ?>"
                                                        data-foto_buku="<?= $book['foto_buku'] ?>"
                                                        data-sinopsis="<?= $book['sinopsis'] ?>"
                                                        data-jenis_buku="<?= $book['jenis_buku'] ?>"
                                                        data-genre="<?= $genreIds ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <!-- Tombol Tambah -->
                                                    <button type="button"
                                                        class="btn btn-outline-success mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tombolTambah"
                                                        data-id="<?= $book['id_buku'] ?>"
                                                        data-judul="<?= $book['judul'] ?>">
                                                        <i class="bi bi-plus-lg"></i>
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
                                <h4 class="m-0 font-weight-bold text-primary">Data Eksemplar</h4>
                                <!-- Button to Open the Modal -->

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
                                                    <?php if ($data['jumlah_peminjaman'] == 0) { ?>
                                                        <button type="button"
                                                            class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal" data-bs-target="#tombolHapusEksemplar"
                                                            data-id="<?= $data['id_eksemplar_buku'] ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    <?php } else { ?>
                                                        <button type="button"
                                                            class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal" data-bs-target="#tombolHapusEksemplar"
                                                            disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    <?php } ?>

                                                    <!-- Tombol Edit -->
                                                    <button type="button"
                                                        class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tombolEditEksemplar"
                                                        data-id="<?= $data['id_eksemplar_buku'] ?>"
                                                        data-judul="<?= $data['judul'] ?>"
                                                        data-lokasi_rak="<?= $data['lokasi_rak'] ?>"
                                                        data-status="<?= $data['status'] ?>">
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
                                                <td>
                                                <?php if($rev['komentar'] == NULL) { echo "-" ;} else { echo $rev['komentar'] ; } ?>
                                                </td>
                                                <td><?= $rev['waktu_ulasan'] ?></td>

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

<?php include "./modal_data_buku.php"; ?>


<script>
    $('#tombolTambah').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var bookId = button.data('id'); // Ambil ID Buku
        var bookTitle = button.data('judul'); // Ambil Judul Buku

        // Masukkan ID Buku ke dalam input tersembunyi di modal
        var modal = $(this);
        modal.find('#idBuku').val(bookId); // Isi field ID Buku
        modal.find('#JudulBuku').val(bookTitle); // Isi field Judul Buku
    });
</script>

<script>
    $('#tombolEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var bookId = button.data('id'); // Ambil ID Buku
        var bookTitle = button.data('judul'); // Ambil Judul Buku
        var bookAuthor = button.data('penulis'); // Ambil Penulis Buku
        var bookIsbn = button.data('isbn'); // Ambil ISBN Buku
        var bookYear = button.data('tahun_terbit'); // Ambil Tahun Terbit Buku
        var bookPublisher = button.data('penerbit'); // Ambil Penerbit Buku
        var bookPhoto = button.data('foto_buku'); // Ambil Foto Buku
        var bookSynopsis = button.data('sinopsis'); // Ambil Sinopsis Buku
        var jenis_buku = button.data('jenis_buku'); // Ambil Jenis Buku
        var selectedGenres = button.data('genre'); // Ambil data-genre
        var genresArray = selectedGenres ? selectedGenres.split(',') : [];

        // Masukkan data ke dalam field input di dalam modal
        var modal = $(this);
        modal.find('#idBuku').val(bookId); // Isi field ID Buku
        modal.find('#Judul').val(bookTitle); // Isi field Judul Buku
        modal.find('#Penulis').val(bookAuthor); // Isi field Penulis Buku
        modal.find('#Isbn').val(bookIsbn); // Isi field ISBN Buku
        modal.find('#TahunTerbit').val(bookYear); // Isi field Tahun Terbit Buku
        modal.find('#Penerbit').val(bookPublisher); // Isi field Penerbit Buku
        modal.find('#FotoBuku').val(bookPhoto); // Isi field Foto Buku
        modal.find('#Sinopsis').val(bookSynopsis); // Isi field Sinopsis Buku

        // Reset semua checkbox genre
        $('input[name="genre[]"]').prop('checked', false);
        // Reset radio buttons terlebih dahulu untuk memastikan tidak ada yang terpilih
        $('input[name="jenis_buku"]').prop('checked', false); // Menghapus status yang terpilih sebelumnya

        // Centang checkbox genre yang sesuai
        genresArray.forEach(function (genreId) {
            $('input[name="genre[]"][value="' + genreId + '"]').prop('checked', true);
        });
        // Menandai radio button yang sesuai dengan status
        if (jenis_buku === "Paket Pelajaran") {
            $('#PaketPelajaran2').prop('checked', true); // Check radio button Paket Pelajaran
        } else if (jenis_buku === "NON Paket Pelajaran") {
            $('#NonPaketPelajaran2').prop('checked', true); // Check radio button Non Paket Pelajaran
        }
    });
</script>

<script>
    $('#tombolEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var bookId = button.data('id'); // Ambil ID Buku
        var bookTitle = button.data('judul'); // Ambil Judul Buku

        // Masukkan ID Buku ke dalam input tersembunyi di modal
        var modal = $(this);
        modal.find('#idBuku').val(bookId); // Isi field ID Buku
        modal.find('#JudulBuku').val(bookTitle); // Isi field Judul Buku
    });
</script>

<script>
    // Event listener untuk membuka modal
    $('#tombolEditEksemplar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var idEksemplar = button.data('id'); // Ambil ID Eksemplar
        var judulBuku = button.data('judul'); // Ambil Judul Buku
        var lokasiRak = button.data('lokasi_rak'); // Ambil Lokasi Rak
        var status = button.data('status'); // Ambil Status Buku

        // Masukkan data ke dalam modal
        var modal = $(this);
        modal.find('#idEksemplar').val(idEksemplar);
        modal.find('#JudulBuku').val(judulBuku);
        modal.find('#LokasiRak').val(lokasiRak);

        // Reset radio buttons
        $('input[name="status"]').prop('checked', false); // Menghapus status yang terpilih sebelumnya

        // Menandai radio button yang sesuai dengan status
        if (status == 'Tersedia') {
            $('#statusTersedia').prop('checked', true);
        } else if (status == 'Dipinjamkan') {
            $('#statusDipinjamkan').prop('checked', true);
        } else if (status == 'Hilang') {
            $('#statusHilang').prop('checked', true);
        } else if (status == 'Rusak') {
            $('#statusRusak').prop('checked', true);
        }
    });
</script>

<script>
    $('#tombolHapusEksemplar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var idEksemplar = button.data('id'); // Ambil ID Eksemplar

        // Masukkan id_eksemplar_buku ke dalam modal
        $(this).find('#idEksemplarBuku').val(idEksemplar);
    });
</script>

<script>
    // Update label saat file dipilih
    document.querySelector('.custom-file-input1').addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'Pilih file...';
        const label = document.querySelector('label[for="uploadImage1"]'); // Pilih label berdasarkan atribut 'for'
        label.textContent = fileName; // Mengubah teks label
        // Menampilkan pratinjau gambar jika file adalah gambar
        const preview = document.getElementById('previewImage1');
    });

    // Update label saat file dipilih
    document.querySelector('.custom-file-input2').addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'Pilih file...';
        const label = document.querySelector('label[for="uploadImage2"]'); // Pilih label berdasarkan atribut 'for'
        label.textContent = fileName; // Mengubah teks label

        // Menampilkan pratinjau gambar jika file adalah gambar
        const preview = document.getElementById('previewImage2');
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

<?php include "./crud/input_buku.php"; ?>
<?php include "./crud/input_eksemplar.php"; ?>
<?php include "./crud/edit_eksemplar.php"; ?>
<?php include "./crud/hapus_eksemplar.php"; ?>
<?php include "./crud/edit_buku.php"; ?>

</html>