<?php

if (isset($_POST['btnEditSiswa'])) {
    $username = $_POST['username'];
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    $foto_profil = $_POST['foto_profil'];
    $id_user_penginput = $_SESSION['id_user'];
    $kelas = $_POST['kelas'];
    $tahun_masuk = $_POST['tahun_masuk'];
    $no_induk = $username;

    $password = mysqli_fetch_assoc(query("SELECT password FROM users WHERE id_user = $id_user"))['password'];

    // Periksa apakah username sudah digunakan oleh user lain
    $res = query("SELECT username FROM users WHERE username='$username' AND id_user != $id_user");

    if ($res && mysqli_num_rows($res) > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Username Sudah Digunakan!'
            }).then(() => window.location = './data_siswa.php');
        </script>
        ";
    } else {
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
                        }).then(() => window.location = './data_siswa.php');
                    </script>
                ";
                exit();  // Hentikan eksekusi lebih lanjut
            }
        } else {
            // Jika tidak ada file yang diupload, gunakan gambar default
            $fileLoc = $foto_profil;
        }
        $conn = conn();
        // Panggil prosedur update_user_dan_pengunjung
        $stmt = $conn->prepare("CALL update_user_dan_pengunjung(?, ?, ?, ?, ?, ?, ?, ?, NULL, ?)");
        $stmt->bind_param(
            "isssssiss",
            $id_user,          // p_id_user
            $username, 
            $password,        // p_username
            $nama,             // p_nama
            $role,             // p_role
            $no_induk,         // p_no_induk
            $tahun_masuk,      // p_tahun_masuk
            $kelas,            // p_kelas
            $fileLoc
        );

        if ($stmt->execute()) {
            // Jika berhasil, tampilkan pesan sukses
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Siswa Berhasil Diupdate!'
                }).then(() => window.location = './data_siswa.php');
            </script>";
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal Mengupdate Data!'
                }).then(() => window.location = './data_siswa.php');
            </script>";
        }

        $stmt->close();
    }
}
?>
