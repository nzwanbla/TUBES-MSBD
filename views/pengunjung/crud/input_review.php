<?php


if (isset($_POST['btnReview'])) {

    $id_peminjaman_buku = $_POST['id_peminjaman_buku'];
    $id_eksemplar = $_POST['id_eksemplar_buku'];

    $id_buku_result = query("SELECT id_buku FROM eksemplar_buku WHERE id_eksemplar_buku = $id_eksemplar ");
    $row = mysqli_fetch_assoc($id_buku_result);

    $id_buku = $row['id_buku']; // Ambil id_user
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $id_user = $_POST['id_user'];

    // Pastikan koneksi ke database sudah dibuat dan tersedia dalam variabel $conn
    $conn = conn();

    // Persiapkan statement untuk update
    $stmt = $conn->prepare("CALL ulasan_buku(?, ?, ?, ?, ?)");
    
    // Bind parameter untuk statement
    $stmt->bind_param("iiisi", $id_peminjaman_buku, $id_buku, $rating, $review ,$id_user);  


    if ($stmt->execute()) {

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Review Buku Berhasil Terkirim!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>";
    } else {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Review Buku Gagal!'
            }).then(() => window.location = './data_peminjaman.php');
        </script>
    ";
    }

    // Tutup statement
    $stmt->close();
}

?>