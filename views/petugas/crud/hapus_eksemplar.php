<?php

if (isset($_POST['btnHapusEks'])) {
    $id_eksemplar_buku = $_POST['id_eksemplar_buku'];

    $conn = conn();

    // Pastikan ID eksemplar ada di database
    $sql = "SELECT * FROM eksemplar_buku WHERE id_eksemplar_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_eksemplar_buku);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Eksekusi penghapusan
        $sqlDelete = "DELETE FROM eksemplar_buku WHERE id_eksemplar_buku = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param('i', $id_eksemplar_buku);
        
        if ($stmtDelete->execute()) {
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Eksemplar Buku Berhasil Dihapus!'
                }).then(() => window.location = './data_buku.php');
            </script>";
        } else {
            echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi Kesalahan Saat Menghapus Eksemplar Buku!'
            }).then(() => window.location = './data_buku.php');
        </script>
    ";
        }
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Id Eksemplar Tidak ditemukan!'
            }).then(() => window.location = './data_buku.php');
        </script>
    ";
    }
} 
?>
