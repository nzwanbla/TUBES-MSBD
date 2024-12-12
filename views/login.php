<?php
session_start(); // Memulai sesi
require '../include/Conn_Function.php';

if (isset($_POST['loginbtn'])) {
    // Ambil data dari form input
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $conn = conn();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password menggunakan password_verify
        if (password_verify($inputPassword, $row['password'])) {
            // Set session untuk pengguna yang berhasil login
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['foto_profil'] = $row['foto_profil'];
            $userLevel = $row['role'];

            // Arahkan pengguna berdasarkan peran (role)
            if ($userLevel == "Admin") {
                $_SESSION['status'] = 'Admin';
                header("Location: ./admin/index.php");
                exit();
            } elseif ($userLevel == "Petugas") {
                $_SESSION['status'] = 'Petugas';
                header("Location: ./petugas/index.php");
                exit();
            } elseif ($userLevel == "Pengunjung") {
                $_SESSION['status'] = 'Pengunjung';
                header("Location: ./pengunjung/index.php");
                exit();
            } elseif ($userLevel == "Non Aktif") {
                echo "
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Sorry..',
                                text: 'Akun Sudah Non Aktif',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location = './login.php';
                            });
                        }
                    </script>
                ";
                exit();
            }
        } else {
            echo "
                <script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sorry..',
                            text: 'Username atau password tidak ditemukan!',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = './login.php';
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
                        title: 'Sorry..',
                        text: 'Username atau password tidak ditemukan!',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location = './login.php';
                    });
                }
            </script>
        ";
    }
    $stmt->close();
    $conn->close();
}
?>




<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/util.css">
	<link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/dist/sweetalert2.min.css">
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(../assets/images/bg-new.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" action="" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<!-- <div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>
					</div> -->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="loginbtn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</body>
