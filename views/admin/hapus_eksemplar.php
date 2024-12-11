<?php
require './include/Admin_Function.php';

if (isset($_POST['id_eksemplar_buku'])) {
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
            echo "<script>
                alert('Eksemplar buku berhasil dihapus!');
                window.location = './data_buku.php';
            </script>";
        } else {
            echo "<script>
                alert('Terjadi kesalahan saat menghapus data!');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('ID Eksemplar Buku tidak ditemukan!');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('ID Eksemplar Buku tidak valid!');
        window.history.back();
    </script>";
}
?>
