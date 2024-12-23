<?php

require './include/Petugas_Function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
    header("Location: ./error-403.php");
}
$data = getDataUsers($_SESSION['username']);


if (isset($_POST['uploadbtn'])) {
    // Ambil data inputan dari form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $conn = conn();
    // Ambil password lama dari database
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $data['username']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($cur_pass); // Mengambil password yang terenkripsi
        $stmt->fetch();

        // Verifikasi password lama
        if (password_verify($current_password, $cur_pass)) {
            // Validasi konfirmasi password sama dengan password baru
            if ($new_password === $confirm_password) {
                // Validasi password baru: minimal 8 karakter
                if (strlen($new_password) >= 8) {
                    // Jika validasi lolos, update password baru
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Enkripsi password baru

                    // Panggil fungsi untuk memperbarui password di database
                    if (updatePassword($data['username'], $hashed_password)) {
                        echo "
                            <script>
                                window.onload = function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Password berhasil diperbarui.',
                                        confirmButtonText: 'OK'
                                    }).then(function() {
                                        window.location = 'change_password.php';
                                    });
                                }
                            </script>
                        ";
                    } else {
                        echo "
                            <script>
                                window.onload = function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Gagal memperbarui password. Silakan coba lagi.',
                                        confirmButtonText: 'OK'
                                    }).then(function() {
                                        window.location = 'change_password.php';
                                    });
                                }
                            </script>
                        ";
                    }
                } else {
                    echo "
                        <script>
                            window.onload = function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Password baru harus terdiri dari minimal 8 karakter.',
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    window.location = './change_password.php';
                                });
                            }
                        </script>
                    ";
                }
            } else {
                echo "
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Konfirmasi password tidak sesuai dengan password baru.',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location = 'change_password.php';
                            });
                        }
                    </script>
                ";
            }
        } else {
            // Jika password lama salah
            echo "
                <script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Password lama yang dimasukkan salah.',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = 'change_password.php';
                        });
                    }
                </script>
            ";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Dashboard User</title>

<?php include "./include/css.php"; ?>
<link rel="stylesheet" href="../../assets/css/profile.css">
<link rel="stylesheet" href="../assets/dist/sweetalert2.min.css">

</head>

<body>
    <div class="container-scroller">
        <!-- include:navbar.php -->
        <?php
        include "./include/navbar.php";
        ?>

        <div class="container-fluid page-body-wrapper">
            <!-- include -->
            <!-- sidebar_settings.php -->
            <?php
            include "../../include/sidebar_setting.php";
            ?>


            <!-- sidebar.php -->
            <?php
            include "./include/sidebar.php";
            ?>

            <!-- Tampilan main yang diubah tiap file -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Perbarui Kata Sandi</h3>
                                    <form class="forms-sample" method="POST" action="">
                                        <div class="form-group">
                                            <label for="current-password">Kata Sandi Saat Ini</label>
                                            <input type="password" class="form-control" id="current-password"
                                                name="current_password" placeholder="Masukkan kata sandi saat ini" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="new-password">Kata Sandi Baru</label>
                                            <input type="password" class="form-control" id="new-password"
                                                name="new_password" placeholder="Masukkan kata sandi baru" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm-password">Konfirmasi Kata Sandi Baru</label>
                                            <input type="password" class="form-control" id="confirm-password"
                                                name="confirm_password" placeholder="Konfirmasi kata sandi baru" required>
                                        </div>

                                        <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Simpan 
                                            Perubahan</button>
                                        <a href="index.php" class="btn btn-light"
                                            onclick="return confirm('Apakah anda yakin ingin meninggalkan perubahan?')">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- include footer -->
                <?php
                include "../../include/footer.php";
                ?>
            </div>
        </div>
    </div>

    <?php include "./include/js.php"; ?>
    <script src="../../assets/js/profile.js"></script>

</body>



</html>