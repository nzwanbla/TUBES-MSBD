<?php


if (isset($_POST['btnTambahGuru'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $role = 'Pengunjung';
    $password = password_hash($username, PASSWORD_DEFAULT);
    $no_induk = $username;
    $id_user_penginput = $_SESSION['id_user'];

    $res = query("SELECT username FROM users WHERE username='$username'");

    if ($res && mysqli_num_rows($res) > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Username Sudah Digunakan!'
            }).then(() => window.location = './data_guru.php');
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
                        }).then(() => window.location = './data_guru.php');
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
        if (inputGuru($dataAssoc) != 1) {
            // Jika update gagal dan file baru diupload, hapus file yang sudah diupload
            if (isset($uploaded) && !$uploaded) {
                unlink($fileLoc);  // Hapus file yang diupload
            }

            echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal Menambahkan data dan mengupload file!'
                    }).then(() => window.location = './data_guru.php');
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
                text: 'Data guru Berhasil Ditambahkan!'
            }).then(() => window.location = './data_guru.php');
        </script>";
    }


}
?>