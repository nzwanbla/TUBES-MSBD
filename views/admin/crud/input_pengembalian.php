<?php

if (isset($_POST['btnPengembalian'])) {
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

    $id_peminjaman_list = []; 
    foreach ($id_eksemplar_buku_list as $id_eksemplar_buku) {
        // Query untuk mengecek apakah peminjaman buku masih aktif
        $cek_id_peminjaman = query("SELECT id_peminjaman_buku 
                                     FROM peminjaman_buku 
                                     WHERE id_eksemplar_buku ='$id_eksemplar_buku' 
                                         AND id_user ='$id_user' 
                                         AND waktu_pengembalian IS NULL");

        // Jika query tidak menemukan data (artinya buku belum dikembalikan)
        if (mysqli_num_rows($cek_id_peminjaman) != 1) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Inputan Buku atau User tidak Valid!'
                }).then(() => window.location = './data_peminjaman.php');
            </script>
            ";
            exit(); // Hentikan eksekusi jika data tidak valid
        }
            // Jika ditemukan id_peminjaman, simpan ke array
            $row2 = mysqli_fetch_assoc($cek_id_peminjaman);
            $id_peminjaman_list[] = $row2['id_peminjaman_buku'];  // Menyimpan id_peminjaman ke dalam array
    }

    // Proses untuk setiap buku yang dipinjam
    $total_denda = 0; // Inisialisasi total denda

    foreach ($id_peminjaman_list as $id_peminjaman) {
        $result = query("SELECT hitung_denda_telat($id_peminjaman) AS denda");

        // Ambil hasil denda dari query
        $row3 = mysqli_fetch_assoc($result);
        $denda = $row3['denda']; // Ambil nilai denda

        // Menambahkan denda ke total_denda
        $total_denda += $denda;

        // Data yang akan dimasukkan ke dalam database untuk pengembalian
        $dataAssoc = array(
            'id_peminjaman' => $id_peminjaman,
            'id_petugas' => $id_petugas
        );

        // Panggil fungsi untuk memasukkan data pengembalian
        if (inputPengembalian($dataAssoc) != 1) {
            echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Mengupdate Data Pengembalian Buku!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
        ";
            exit(); // Hentikan eksekusi jika gagal memasukkan data pengembalian
        }
    }
    if ($total_denda > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Denda Telat!',
                text: 'Total Denda Anda adalah Rp " . number_format($total_denda, 0, ',', '.') . "'
            }).then(() => window.location = './data_denda.php');
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Peminjaman Buku Berhasil Diupdate!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
        ";
    }
}
?>