<?php


if (isset($_POST['btnSetuju'])) {

    $id_request = $_POST['id_request'];
    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $id_user = $_POST['id_user'];
    $id_petugas = $_SESSION['id_user'];

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("CALL approve_perpanjangan(?, ?)");
    
    // Bind parameter untuk statement
    $stmt->bind_param("ii", $id_request, $id_petugas);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Request Perpanjangan Buku disetujui!'
            }).then(() => window.location = './data_request_perpanjangan.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Request Perpanjangan Buku Gagal!'
            }).then(() => window.location = './data_request_perpanjangan.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();
}

if (isset($_POST['btnTolak'])) {

    $id_request = $_POST['id_request'];
    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $id_user = $_POST['id_user'];
    $id_petugas = $_SESSION['id_user'];
    $status = "Ditolak";

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("UPDATE request_perpanjangan_buku
                                    SET status = ?
                                    WHERE id_request = ? ");
    
    // Bind parameter untuk statement
    $stmt->bind_param("si", $status, $id_request);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Request Perpanjangan Buku ditolak!'
            }).then(() => window.location = './data_request_perpanjangan.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Request Perpanjangan Buku gagal!'
            }).then(() => window.location = './data_request_perpanjangan.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();
}
?>