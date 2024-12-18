<?php

if (isset($_POST['btnDenda'])) {
    // Ambil data dari form
    $nisn = $_POST['nisn'];
    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $keterangan = $_POST['keterangan'];
    $denda = $_POST['denda'];
    $telat = 0;
    $denda_per_hari = 0;
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



    // Data yang akan dimasukkan ke dalam database untuk pengembalian
    $dataAssoc = array(
        'id_peminjaman_buku' => $id_peminjaman_buku,
        'id_user' => $id_user,
        'keterangan' => $keterangan,
        'hari_telat' => $telat,
        'denda_per_hari' => $denda_per_hari,
        'denda' => $denda,
        'id_petugas' => $id_petugas
    );

    $res = query("UPDATE peminjaman_buku
                    SET waktu_pengembalian = CURRENT_TIMESTAMP
                    WHERE id_peminjaman_buku = '$id_peminjaman_buku' ");

    $log = query("INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
                    VALUES ($id_petugas, 'peminjaman_buku', 'UPDATE',
                        JSON_OBJECT(
                            'id_peminjaman_buku', $id_peminjaman_buku,
                            'waktu_pengembalian', CURRENT_TIMESTAMP)) ");

    // Panggil fungsi untuk memasukkan data pengembalian
    if (inputDenda($dataAssoc) AND $res AND $log != 1) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Mengupdate Data Denda Buku!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
        ";
        exit(); // Hentikan eksekusi jika gagal memasukkan data pengembalian
    }

    if ($keterangan == "Hilang") {
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Denda Hilang Buku!',
                text: 'Total Denda Anda adalah Rp " . number_format($denda, 0, ',', '.') . "'
            }).then(() => window.location = './data_denda.php');
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Denda Rusak Buku!',
                text: 'Total Denda Anda adalah Rp " . number_format($denda, 0, ',', '.') . "'
            }).then(() => window.location = './data_denda.php');
        </script>
        ";
    }
}
?>