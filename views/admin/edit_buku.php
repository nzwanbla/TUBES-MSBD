<?php

require './include/Admin_Function.php';

if (isset($_POST['uploadbtn'])) {
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $jenis_buku = $_POST['jenis_buku'];
    $isbn = $_POST['isbn'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];
    $sinopsis = $_POST['sinopsis'];
    $foto_buku = $_POST['fotoBuku'];

    // Cek jika genre tidak dipilih, set $id_genres ke NULL
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $id_genres = implode(',', $_POST['genre']);  // Menggabungkan ID genre yang dipilih menjadi string
    } else {
        $id_genres = '1';  // Set ke NULL jika tidak ada genre yang dipilih
    }

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
        } else {
            // Jika folder sudah ada, hapus gambar lama jika ada
            $existingFile = glob($bookDir . '*');  // Cari semua file di folder
            if (!empty($existingFile)) {
                // Hapus file gambar lama jika ada
                foreach ($existingFile as $file) {
                    unlink($file);  // Hapus file
                }
            }
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
        $fileLoc = $foto_buku;
    }

    // Array data untuk dimasukkan ke database
    $dataAssoc = array(
        'id_buku' => $id_buku,
        'judul' => $judul,
        'penulis' => $penulis,
        'jenis_buku' => $jenis_buku,
        'isbn' => $isbn,
        'tahun_terbit' => $tahun_terbit,
        'penerbit' => $penerbit,
        'foto_buku' => $fileLoc,  // Path ke gambar buku
        'sinopsis' => $sinopsis,
        'genre' => $id_genres,  // ID genre buku
        'id_user_penginput' => $id_user_penginput  // ID pengguna penginput dari session
    );

    // Panggil procedure untuk memasukkan data buku ke dalam database
    if (updateBuku($dataAssoc) != 1) {
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
