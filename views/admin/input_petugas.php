<?php

require './include/Admin_Function.php';



if (isset($_POST['uploadbtn'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $role = 'Petugas';
    $password = password_hash($username, PASSWORD_DEFAULT);
    $id_user_penginput = $_SESSION['id_user'];

    $res = query("SELECT username FROM users WHERE username='$username'");

    if ($res == true) {
        echo "
        <script>
            alert('Username Sudah digunakan');
            window.history.back();
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
                        alert('Gagal mengupload file!');
                        window.history.back();
                    </script>
                ";
                exit();  // Hentikan eksekusi lebih lanjut
            }
        } else {
            // Jika tidak ada file yang diupload, gunakan gambar default
            $fileLoc = '../../assets/images/profil/default_profile.jpg';
        }

        // Array data untuk dimasukkan ke database
        $dataAssoc = array(
            'username' => $username,
            'nama' => $nama,
            'role' => $role,
            'password' => $password,
            'foto_profil' => $fileLoc,
            'id_user_penginput' => $id_user_penginput
        );

        // Panggil procedure untuk memasukkan data buku ke dalam database
        if (inputPetugas($dataAssoc) != 1) {
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
            window.location = './data_petugas.php';
        </script>";
    }


}
?>