<?php


if (isset($_POST['btnEditEks'])) {

    $id_eksemplar = $_POST['id_eksemplar'];
    $lokasi_rak = $_POST['lokasi_rak'];
    $status = $_POST['status'];
    $id_user_penginput = $_SESSION['id_user']; 

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("UPDATE eksemplar_buku 
                                    SET lokasi_rak = ?, 
                                    status = ? 
                                    WHERE id_eksemplar_buku = ?");
    
    // Bind parameter untuk statement
    $stmt->bind_param("ssi", $lokasi_rak, $status, $id_eksemplar);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Eksemplar Buku Berhasil Diupdate!'
            }).then(() => window.location = './data_buku.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Mengedit Eksemplar Buku!'
            }).then(() => window.location = './data_buku.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();

}
?>