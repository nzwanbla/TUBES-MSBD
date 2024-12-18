<?php

$data = getDataUsers($_SESSION['username']);

if (isset($_POST['uploadbtn'])) {

    // Ambil data dari POST
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    $no_induk = $_POST['no_induk'];
    $tahun_masuk = !empty($_POST['tahun_masuk']) ? $_POST['tahun_masuk'] : null;
    $kelas = !empty($_POST['kelas']) ? $_POST['kelas'] : null;
    $alamat = !empty($_POST['alamat']) ? $_POST['alamat'] : null;
    $id_user_pengedit = $_POST['id_user'];

    // Cek apakah file diupload
    if ($_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
        $namaFile = $_FILES['berkas']['name'];
        $tmpFile = $_FILES['berkas']['tmp_name'];

        // Tentukan direktori utama
        $baseDir = '../../assets/images/profil/';
        
        // Tentukan direktori spesifik untuk username
        $userDir = $baseDir . $username . '/';

        // Periksa apakah direktori username sudah ada
        if (!is_dir($userDir)) {
            // Jika belum ada, buat direktori dengan permission 0755
            mkdir($userDir, 0755, true);
        } else {
            // Jika folder sudah ada, hapus gambar lama jika ada
            $existingFile = glob($userDir . '*');  // Cari semua file di folder
            if (!empty($existingFile)) {
                // Hapus file gambar lama jika ada
                foreach ($existingFile as $file) {
                    unlink($file);  // Hapus file
                }
            }
        }

        // Lokasi file yang akan dipindahkan
        $fileLoc = $userDir . $namaFile;

        // Pindahkan file ke lokasi yang ditentukan
        $uploaded = move_uploaded_file($tmpFile, $fileLoc);

        // Jika upload gagal, batalkan seluruh proses
        if (!$uploaded) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengunggah file!',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = './profile.php';
                });
            </script>";
            exit();  // Hentikan eksekusi lebih lanjut
        }
    } else {
        // Jika tidak ada file yang diupload, gunakan foto profil dari session
        // Anda bisa menggunakan foto yang tersimpan dalam session atau di database
        $fileLoc = $data['foto_profil'];  // Asumsi foto profil disimpan dalam session
    }

    // Array data untuk dimasukkan ke database
    $dataAssoc = array(
        'id_user' => $id_user,
        'username' => $username,
        'nama' => $nama,
        'role' => $role,
        'no_induk' => $no_induk,
        'tahun_masuk' => $tahun_masuk,
        'kelas' => $kelas,
        'alamat' => $alamat,
        'fileLoc' => $fileLoc,
        'id_user_pengedit' => $id_user_pengedit
    );

    // Jika fungsi updateUserDanPengunjung gagal, hapus file dan batalkan proses
    if (updateUserDanPengunjung($dataAssoc) != 1) {
        // Jika update gagal dan file baru diupload, hapus file yang sudah diupload
        if (isset($uploaded) && !$uploaded) {
            unlink($fileLoc);
        }

        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui data.',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = './profile.php';
            });
        </script>";
        exit();  // Hentikan eksekusi lebih lanjut
    }

    // Jika berhasil, tampilkan pesan sukses
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil diperbarui.',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = './profile.php';
            });
        </script>";
}
?>
