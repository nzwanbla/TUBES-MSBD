<?php


if (isset($_POST['btnEdit'])) {

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

    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $id_eksemplar_buku = $_POST['id_eksemplar_buku'];
    $perpanjangan = $_POST['perpanjangan'];
    $id_user_penginput = $_SESSION['id_user']; 

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("UPDATE peminjaman_buku 
                                    SET id_user = ?, 
                                    id_eksemplar_buku = ?,
                                    perpanjangan = ? 
                                    WHERE id_peminjaman_buku = ?");
    
    // Bind parameter untuk statement
    $stmt->bind_param("iiii", $id_user, $id_eksemplar_buku, $perpanjangan, $id_peminjaman_buku);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Peminjaman Buku Berhasil Diupdate!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Mengedit Peminjaman Buku!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();

}
?>