<?php

if (isset($_POST['btnTambahPeminjaman'])) {
    // Ambil data dari form
    $nisn = $_POST['nisn'];
    $id_petugas = $_SESSION['id_user']; // ID petugas dari session
    
    // Query untuk mendapatkan id_user berdasarkan nisn
    $id_user_result = query("SELECT id_user FROM pengunjung WHERE no_induk = '$nisn'");

    // Jika query tidak menemukan data (nisn tidak ada)
    if (mysqli_num_rows($id_user_result) == 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'NISN/NIP tidak ditemukan!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
        ";
        exit(); // Hentikan eksekusi jika NISN tidak ditemukan
    }

    // Ambil id_user dari hasil query
    $row = mysqli_fetch_assoc($id_user_result);
    $id_user = $row['id_user']; // Ambil id_user

    // Ambil ID eksemplar buku yang dipinjam (bisa banyak)
    $id_eksemplar_buku_list = $_POST['id_eksemplar_buku']; // Misalnya, input berupa array
    
    foreach($id_eksemplar_buku_list as $id_eksemplar_buku){
        $cek_status_buku = query("SELECT status FROM eksemplar_buku WHERE id_eksemplar_buku = '$id_eksemplar_buku' AND status != 'tersedia' ");

    // Jika query tidak menemukan data (nisn tidak ada)
    if (mysqli_num_rows($cek_status_buku) > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Inputan Buku tidak Valid!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
        ";
        exit(); // Hentikan eksekusi jika NISN tidak ditemukan
    }
    }

    // Proses untuk setiap buku yang dipinjam
    foreach ($id_eksemplar_buku_list as $id_eksemplar_buku) {
        // Data yang akan dimasukkan ke dalam database
        $dataAssoc = array(
            'id_user' => $id_user,
            'id_eksemplar_buku' => $id_eksemplar_buku,
            'id_petugas' => $id_petugas
        );

        // Panggil fungsi untuk memasukkan data peminjaman
        if (inputPeminjaman($dataAssoc) != 1) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal Menambahkan Data Peminjaman Buku!'
                }).then(() => window.location = './data_peminjaman.php');
            </script>
            ";
            exit(); // Hentikan eksekusi jika gagal memasukkan data
        }
    }

    // Jika berhasil menambahkan peminjaman
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Peminjaman Buku Berhasil Ditambahkan!'
        }).then(() => window.location = './data_peminjaman.php');
    </script>
    ";
}
?>
