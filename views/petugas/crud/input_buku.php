<?php

if (isset($_POST['btnTambahBuku'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $jenis_buku = $_POST['jenis_buku'];
    $isbn = $_POST['isbn'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];
    $sinopsis = $_POST['sinopsis'];

    // Cek jika genre tidak dipilih, set $id_genres ke NULL
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $id_genres = implode(',', $_POST['genre']);  // Menggabungkan ID genre yang dipilih menjadi string
    } else {
        $id_genres = '1';  // Set ke NULL jika tidak ada genre yang dipilih
    }
    
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
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengupload file!'
                }).then(() => window.location = './data_buku.php');
            </script>";
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
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengupdate data dan upload file!'
            }).then(() => window.location = './data_buku.php');
        </script>";
        exit();  // Hentikan eksekusi lebih lanjut
    }

    // Jika berhasil, tampilkan pesan sukses
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Buku Berhasil Ditambahkan!'
        }).then(() => window.location = './data_buku.php');
    </script>";

}
?>
