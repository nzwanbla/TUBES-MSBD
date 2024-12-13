
<?php

$data = getDataUsers($_SESSION['username']);

if (isset($_POST['uploadbtn'])) {

    // Ambil data dari POST
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];

    $fileLoc = $data['foto_profil']; // Default lokasi file (jika tidak ada unggahan baru)

    // Validasi unggahan file
    if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2 MB

        $fileType = $_FILES['berkas']['type'];
        $fileSize = $_FILES['berkas']['size'];
        $namaFile = basename($_FILES['berkas']['name']);
        $tmpFile = $_FILES['berkas']['tmp_name'];

        // Validasi tipe file
        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Hanya file berformat JPG, PNG, atau GIF yang diperbolehkan.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = './profile.php';
                });
            </script>";
            exit();
        }

        // Validasi ukuran file
        if ($fileSize > $maxSize) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Ukuran file tidak boleh lebih dari 2MB.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = './profile.php';
                });
            </script>";
            exit();
        }

        // Tentukan direktori utama
        $baseDir = '../../assets/images/profil/';
        $userDir = $baseDir . $username . '/';

        // Periksa apakah direktori username sudah ada
        if (!is_dir($userDir)) {
            mkdir($userDir, 0755, true); // Buat direktori jika belum ada
        } else {
            // Jika folder sudah ada, hapus gambar lama
            $existingFiles = glob($userDir . '*');
            foreach ($existingFiles as $file) {
                unlink($file);
            }
        }

        // Tentukan lokasi baru file
        $fileLoc = $userDir . $namaFile;

        // Pindahkan file ke lokasi yang ditentukan
        if (!move_uploaded_file($tmpFile, $fileLoc)) {
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
            exit();
        }
    }

    // Array data untuk dimasukkan ke database
    $dataAssoc = [
        'id_user' => $id_user,
        'username' => $username,
        'nama' => $nama,
        'role' => $role,
        'fileLoc' => $fileLoc
    ];

    // Update database
    if (updateUserDanPengunjung($dataAssoc) == 1) {
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
    } else {
        // Jika update gagal
        if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
            unlink($fileLoc); // Hapus file baru jika gagal menyimpan ke database
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
    }
}
?>


