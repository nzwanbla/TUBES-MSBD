<?php


if (isset($_POST['btnEditPetugas'])) {
    $username = $_POST['username'];
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    $foto_profil = $_POST['foto_profil'];
    $id_user_penginput = $_SESSION['id_user'];

    
    $res = query("SELECT username FROM users WHERE username='$username' AND id_user !=$id_user ");

    if ($res && mysqli_num_rows($res) > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Username Sudah Digunakan!'
            }).then(() => window.location = './data_petugas.php');
        </script>
    ";
    } 
    else
    {
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal Mengupload File!'
                        }).then(() => window.location = './data_petugas.php');
                    </script>
                ";
                exit();  // Hentikan eksekusi lebih lanjut
            }
        } else {
            // Jika tidak ada file yang diupload, gunakan gambar default
            $fileLoc = $foto_profil;
        }

        $res = query("UPDATE users
                        SET nama = '$nama',
                        role = '$role',
                        foto_profil = '$fileLoc',
                        username = '$username'
                        WHERE id_user = '$id_user' ");

        // Panggil procedure untuk memasukkan data buku ke dalam database
        if ($res != 1) {
            // Jika update gagal dan file baru diupload, hapus file yang sudah diupload
            if (isset($uploaded) && !$uploaded) {
                unlink($fileLoc);  // Hapus file yang diupload
            }

            echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal Mengupdate Data dan mengupload File!'
                    }).then(() => window.location = './data_petugas.php');
                </script>
            ";
            exit();  // Hentikan eksekusi lebih lanjut
        }

        // Jika berhasil, tampilkan pesan sukses
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Petugas Berhasil Diupdate!'
            }).then(() => window.location = './data_petugas.php');
        </script>";


    }
}
?>