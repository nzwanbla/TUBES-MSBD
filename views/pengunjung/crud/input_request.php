<?php


if (isset($_POST['btnRequest'])) {

    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $id_user = $_POST['id_user'];

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("CALL request_perpanjangan(?, ?)");
    
    // Bind parameter untuk statement
    $stmt->bind_param("ii", $id_peminjaman_buku, $id_user);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Request Perpanjangan Diajukan!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Request Perpanjangan Gagal!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();
}

?>