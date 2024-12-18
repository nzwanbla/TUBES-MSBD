<?php


if (isset($_POST['btnResetPass'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = password_hash($username, PASSWORD_DEFAULT);

    $res = query("UPDATE users
                    SET password = '$password'
                    WHERE id_user = '$id_user' ");

    // Panggil procedure untuk memasukkan data buku ke dalam database
    if ($res != 1) {

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Melakukan Reset Password!'
            }).then(() => window.history.back());
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
            text: 'Reset Password Berhasil Dilakukan!'
        }).then(() => window.history.back());
    </script>";



}
?>