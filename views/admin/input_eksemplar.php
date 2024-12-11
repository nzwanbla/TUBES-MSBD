<?php

require './include/Admin_Function.php';



if (isset($_POST['uploadbtn'])) {

    $id_buku = $_POST['id_buku'];
    $jumlah_eksemplar = $_POST['jumlah_eksemplar'];
    $lokasi_rak = $_POST['lokasi_rak'];
    $id_user_penginput = $_SESSION['id_user']; 


    // Array data untuk dimasukkan ke database
    $dataAssoc = array(
        'id_buku' => $id_buku,
        'jumlah_eksemplar' => $jumlah_eksemplar,
        'lokasi_rak' => $lokasi_rak,
        'id_user_penginput' => $id_user_penginput  // ID pengguna penginput dari session
    );

    // Panggil procedure untuk memasukkan data buku ke dalam database
    if (inputEksemplar($dataAssoc) != 1) {
        echo "
        <script>
            alert('Gagal menambahkan data eksemplar buku!');
            window.history.back();
        </script>
    ";
        exit();  // Hentikan eksekusi lebih lanjut
    }

    // Jika berhasil, tampilkan pesan sukses
    echo "
    <script>
        alert('Berhasil Menambahkan data eksemplar buku!');
        window.location = './data_buku.php';
    </script>";

}
?>