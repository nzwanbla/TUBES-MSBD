<?php

require './include/Pengunjung_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
    header("Location: ./error-403.php");
}

$id_u = $_SESSION['id_user'];
$review = query("SELECT * FROM view_ulasan_buku WHERE id_user = $id_u  ORDER BY waktu_ulasan DESC");

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

    <!-- include/footer.php -->
    <?php
    include "../../include/footer.php";
    ?>

    <?php include "./include/js.php"; ?>

    <!-- Page level custom scripts -->


</body>





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


</html>