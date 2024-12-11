<?php

require './include/Admin_Function.php';



if (isset($_POST['uploadbtn'])) {
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
                alert('Gagal melakukan reset password');
                window.history.back();
            </script>
        ";
        exit();  // Hentikan eksekusi lebih lanjut
    }

    // Jika berhasil, tampilkan pesan sukses
    echo "
        <script>
            alert('Password berhasil direset');
            window.location = './data_petugas.php';
        </script>";



}
?>