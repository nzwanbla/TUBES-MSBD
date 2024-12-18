<?php


if (isset($_POST['btnEdit'])) {

    $denda = $_POST['denda'];
    $keterangan = $_POST['keterangan'];
    $id_denda_buku = $_POST['id_denda_buku'];
    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $id_eksemplar_buku = $_POST['id_eksemplar_buku'];
    $id_user_penginput = $_SESSION['id_user']; 

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("UPDATE denda_buku 
                                    SET besaran_denda = ?,
                                    keterangan = ?
                                    WHERE id_denda_buku = ?");
    
    // Bind parameter untuk statement
    $stmt->bind_param("isi", $denda, $keterangan, $id_denda_buku);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Denda Buku Berhasil Diupdate!'
            }).then(() => window.location = './data_denda.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Mengedit Denda Buku!'
            }).then(() => window.location = './data_denda.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();

}
?>