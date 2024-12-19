<?php

require './include/Pengunjung_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
    header("Location: ./error-403.php");
}

$id_user = $_SESSION['id_user'];

$res = getDataPeminjaman($id_user, "Non Paket Pelajaran");
$res2 = getDataPeminjaman($id_user, "Paket Pelajaran");

date_default_timezone_set('Asia/Jakarta');

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
            <ul id="nav-tabs">
                <li><a href="#">Non Paket Pelajaran</a>
                    <section style="max-height: 500px; overflow-y: auto;">
                        <div class="card mb-4">
                            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                                <h4 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h4>
                                <!-- <a href="" class="btn btn-primary">Ekspor ke Excel</a> -->
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover1">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Id Eks Buku</th>
                                            <th>Judul</th>
                                            <th>Tgl Dipinjam</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Tgl Kembali</th>
                                            <th>Perpanjangan</th>
                                            <th>Denda</th>
                                            <th>Keterangan</th>
                                            <th>Petugas</th>
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
                                                <td><?= $data['judul_buku'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($data['waktu_peminjaman'])) ?></td>
                                                <td>
                                                    <?php
                                                    // Hitung jatuh tempo
                                                    $tanggal_peminjaman = strtotime($data['waktu_peminjaman']);
                                                    $jatuh_tempo = $tanggal_peminjaman + ($data['perpanjangan'] ? (9 * 24 * 60 * 60) : (6 * 24 * 60 * 60));
                                                    echo date('d-m-Y', $jatuh_tempo);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Tanggal kembali
                                                    if ($data['waktu_pengembalian'] == null) {
                                                        echo "-";
                                                    } else {
                                                        echo date('d-m-Y', strtotime($data['waktu_pengembalian']));
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($data['status'] == 'Diterima' OR $data['perpanjangan'] == TRUE) {
                                                            echo "Diperpanjang";
                                                        } elseif ($data['status'] == null) {
                                                            echo "-";
                                                        } else {
                                                            echo $data['status'];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Denda
                                                    if ($data['denda'] == null) {
                                                        echo "-";
                                                    } else {
                                                        echo "Rp. " . number_format($data['denda'], 0, ',', '.');
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Keterangan
                                                    if ($data['keterangan'] == null && $data['waktu_pengembalian'] == null) {
                                                        echo "Dipinjamkan";
                                                    } elseif ($data['waktu_pengembalian'] != null && $data['keterangan'] == null) {
                                                        echo "Dikembalikan";
                                                    } else {
                                                        echo $data['keterangan'];
                                                    }
                                                    ?>
                                                </td>

                                                <td><?= $data['nama_petugas'] ?></td>
                                                <td>
                                                    <?php
                                                    $waktu_pengembalian = $data['waktu_pengembalian'];
                                                    $id_p = $data['id_peminjaman_buku'];
                                                    $cek_review = query("SELECT COUNT(*) AS jumlah FROM ulasan_buku WHERE id_peminjaman = $id_p ");
                                                    $row = mysqli_fetch_assoc($cek_review);

                                                    $reviewTrue = $row['jumlah']; // Ambil id_user
                                                    ?>

                                                
                                                    <button type="button"
                                                        class="btn btn-outline-success mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#tombolRequest" 
                                                        <?php if ($waktu_pengembalian != null OR $data['perpanjangan'] == TRUE OR $data['status'] != null)
                                                            echo 'disabled'; ?>
                                                        data-id="<?= $data['id_peminjaman_buku'] ?>"
                                                        data-id_user ="<?= $_SESSION['id_user']?>">
                                                        <i class="bi bi-clock"></i>
                                                    </button>

                                                   
                                                    <button type="button"
                                                        class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="modal" 
                                                        <?php if ($waktu_pengembalian == null OR $reviewTrue > 0)
                                                            echo 'disabled'; ?>
                                                        data-bs-target="#tombolReview"
                                                        data-id_buku="<?= $data['id_eksemplar_buku'] ?>" 
                                                        data-id_peminjaman="<?= $data['id_peminjaman_buku'] ?>" 
                                                        data-id_user="<?= $data['id_user'] ?>"
                                                        data-judul="<?= htmlspecialchars($data['judul_buku'], ENT_QUOTES) ?>">
                                                        <i class="bi bi-star"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                            <?php $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </li>
                <li><a href="#">Paket Pelajaran</a>
                <section style="max-height: 500px; overflow-y: auto;">
                        <div class="card mb-4">
                            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                                <h4 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h4>
                                <!-- <a href="" class="btn btn-primary">Ekspor ke Excel</a> -->
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Id Eks Buku</th>
                                            <th>Judul</th>
                                            <th>Tgl Dipinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th>Denda</th>
                                            <th>Keterangan</th>
                                            <th>Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($res2 as $data2) {
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $data2['id_eksemplar_buku'] ?></td>
                                                <td><?= $data2['judul_buku'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($data2['waktu_peminjaman'])) ?></td>
                                                <td>
                                                    <?php
                                                    // Tanggal kembali
                                                    if ($data2['waktu_pengembalian'] == null) {
                                                        echo "-";
                                                    } else {
                                                        echo date('d-m-Y', strtotime($data2['waktu_pengembalian']));
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Denda
                                                    if ($data2['denda'] == null) {
                                                        echo "-";
                                                    } else {
                                                        echo "Rp. " . number_format($data2['denda'], 0, ',', '.');
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Keterangan
                                                    if ($data2['keterangan'] == null && $data2['waktu_pengembalian'] == null) {
                                                        echo "Dipinjamkan";
                                                    } elseif ($data2['waktu_pengembalian'] != null && $data2['keterangan'] == null) {
                                                        echo "Dikembalikan";
                                                    } else {
                                                        echo $data2['keterangan'];
                                                    }
                                                    ?>
                                                </td>

                                                <td><?= $data2['nama_petugas'] ?></td>
                                            </tr>
                                            <?php $i++;
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
    <!-- include/footer.php -->
    <?php
    include "../../include/footer.php";
    ?>
    </div>

    <div class="modal fade" id="tombolRequest">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Ajukan Perpanjangan</h4>
					<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
				</div>
                <!-- Modal Body -->
                <div class="modal-body">
                    Ajukan Permintaan Perpanjangan Buku Ini?
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <form action="" method="POST">
                        <input type="hidden" name="id_user" id="idUser">
                        <input type="hidden" name="id_peminjaman_buku" id="idPeminjaman">
                        <button type="submit" name="btnRequest" class="btn btn-primary">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tombolReview">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Ulasan Buku</h4>
					<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
				</div>
                <!-- Modal Body -->
                <form action="" method="POST">
                    <div class="modal-body">
                    
                        <div class="mb-3">
                            <label for="judul-buku" class="form-label">Judul Buku:</label>
                            <input type="text" class="form-control" id="judul-buku" name="judul_buku" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating:</label>
                            <div id="rating-stars" class="d-flex">
                                <!-- Stars -->
                                <i class="bi bi-star star" data-value="1"></i>
                                <i class="bi bi-star star" data-value="2"></i>
                                <i class="bi bi-star star" data-value="3"></i>
                                <i class="bi bi-star star" data-value="4"></i>
                                <i class="bi bi-star star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating-value">
                        </div>
                        <div class="mb-3">
                            <label for="review-text" class="form-label">Ulasan:</label>
                            <textarea class="form-control" id="review-text" name="review" rows="4" placeholder="Tulis ulasan Anda di sini..."></textarea>
                        </div>
                        
                        <input type="hidden" name="id_eksemplar_buku" id="review-id-buku">
                        <input type="hidden" name="id_peminjaman_buku" id="review-id-peminjaman">
                        <input type="hidden" name="id_user" id="review-id-user">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnReview" class="btn btn-primary">Kirim Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php include "./include/js.php"; ?>


    <script>
        $('#tombolRequest').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var idUser = button.data('id_user'); // Mengambil data-id_user dari tombol
            var idPeminjaman = button.data('id'); // Mengambil data-id_peminjaman dari tombol

            // Menyimpan data ke dalam hidden input field di modal
            var modal = $(this);
            modal.find('#idPeminjaman').val(idPeminjaman);
			modal.find('#idUser').val(idUser);
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('rating-value');
        const modalReview = document.getElementById('tombolReview');

        // Set default rating saat modal dibuka
        modalReview.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const idBuku = button.getAttribute('data-id_buku');
            const idPeminjaman = button.getAttribute('data-id_peminjaman');
            const idUser = button.getAttribute('data-id_user');
            const judulBuku = button.getAttribute('data-judul'); // Ambil judul dari tombol

            // Isi field di dalam modal
            document.getElementById('review-id-buku').value = idBuku;
            document.getElementById('review-id-peminjaman').value = idPeminjaman;
            document.getElementById('review-id-user').value = idUser;
            document.getElementById('judul-buku').value = judulBuku; // Isi judul buku

            // Reset bintang dan rating
            stars.forEach((s) => s.classList.remove('bi-star-fill'));
            stars.forEach((s) => s.classList.add('bi-star'));
            ratingValue.value = 0; // Set nilai default rating
        });

        // Event klik pada bintang
        stars.forEach((star) => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingValue.value = value;

                // Reset semua bintang
                stars.forEach((s) => s.classList.remove('bi-star-fill'));
                stars.forEach((s) => s.classList.add('bi-star'));

                // Set bintang hingga nilai yang dipilih
                for (let i = 0; i < value; i++) {
                    stars[i].classList.remove('bi-star');
                    stars[i].classList.add('bi-star-fill');
                }
            });
        });
    });



    </script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover1').DataTable(); // ID From dataTable with Hover
            $('#dataTableHover2').DataTable(); // ID From dataTable with Hover
        });
    </script>

    <?php include "./crud/input_request.php"; ?>
    <?php include "./crud/input_review.php"; ?>

</body>

</html>