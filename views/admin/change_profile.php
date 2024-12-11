<?php
require './include/Admin_Function.php';

$data = getDataUsers($_SESSION['username']);

if (isset($_POST['uploadbtn'])) {

    // Ambil data dari POST
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];

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
            echo "
                <script>
                    alert('Gagal mengupload file!');
                    window.history.back();
                </script>
            ";
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
        'fileLoc' => $fileLoc
    );

    // Jika fungsi updateUserDanPengunjung gagal, hapus file dan batalkan proses
    if (updateUserDanPengunjung($dataAssoc) != 1) {
        // Jika update gagal dan file baru diupload, hapus file yang sudah diupload
        if (isset($uploaded) && !$uploaded) {
            unlink($fileLoc);
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
            window.location = './profile.php';
        </script>
    ";
}
?>
