<?php

require './include/Petugas_Function.php';



if (isset($_POST['uploadbtn'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $jenis_buku = $_POST['jenis_buku'];
    $isbn = $_POST['isbn'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];
    $sinopsis = $_POST['sinopsis'];
    $id_genres = implode(',', $_POST['genre']);  // Menggabungkan ID genre yang dipilih menjadi string
    $jumlah_eksemplar = $_POST['jumlah_eksemplar'];
    $lokasi_rak = $_POST['lokasi_rak'];
    $id_user_penginput = $_SESSION['id_user']; 

    if ($_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
        $namaFile = $_FILES['berkas']['name'];
        $tmpFile = $_FILES['berkas']['tmp_name'];

        // Ambil nama buku dari input form
        $judulBuku = $_POST['judul'];

        // Tentukan direktori utama
        $baseDir = '../../assets/images/book/';

        // Tentukan direktori spesifik untuk judul buku
        $bookDir = $baseDir . $judulBuku . '/';

        // Periksa apakah direktori buku sudah ada
        if (!is_dir($bookDir)) {
            // Jika belum ada, buat direktori dengan permission 0755
            mkdir($bookDir, 0755, true);
        }

        // Lokasi file yang akan dipindahkan
        $fileLoc = $bookDir . $namaFile;

        // Pindahkan file ke lokasi yang ditentukan
        $uploaded = move_uploaded_file($tmpFile, $fileLoc);

        // Jika upload gagal, batalkan seluruh proses
        if (!$uploaded) {
            echo "
            <script>
                alert('Gagal mengupload file!');
                window.history.back();
            </script>
        ";
            exit();  // Hentikan eksekusi lebih lanjut
        }
    } else {
        // Jika tidak ada file yang diupload, gunakan gambar default
        $fileLoc = '../../assets/images/book/default_book.jpg';
    }

    // Array data untuk dimasukkan ke database
    $dataAssoc = array(
        'judul' => $judul,
        'penulis' => $penulis,
        'jenis_buku' => $jenis_buku,
        'isbn' => $isbn,
        'tahun_terbit' => $tahun_terbit,
        'penerbit' => $penerbit,
        'foto_buku' => $fileLoc,  // Path ke gambar buku
        'sinopsis' => $sinopsis,
        'genre' => $id_genres,  // ID genre buku
        'jumlah_eksemplar' => $jumlah_eksemplar,
        'lokasi_rak' => $lokasi_rak,
        'id_user_penginput' => $id_user_penginput  // ID pengguna penginput dari session
    );

    // Panggil procedure untuk memasukkan data buku ke dalam database
    if (inputBuku($dataAssoc) != 1) {
        // Jika update gagal dan file baru diupload, hapus file yang sudah diupload
        if (isset($uploaded) && !$uploaded) {
            unlink($fileLoc);  // Hapus file yang diupload
        }

        echo "
        <script>
            alert('Gagal mengupdate data dan upload file!');
            window.history.back();
        </script>
    ";
        exit();  // Hentikan eksekusi lebih lanjut
    }

    // Jika berhasil, tampilkan pesan sukses
    echo "
    <script>
        alert('File berhasil diupload dan data berhasil diupdate!');
        window.location = './data_buku.php';
    </script>";

}
?>