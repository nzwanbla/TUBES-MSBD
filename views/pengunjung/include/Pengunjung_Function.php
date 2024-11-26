<?php

if (!isset($_SESSION)) {
    session_start();
}

function conn()
{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'dbperpussman2';

    return mysqli_connect($host, $user, $pass, $database);
}
$db = 'dbperpussman2';

function query($query)
{
    return mysqli_query(conn(), $query);
}

function getDataUsers($username)
{
    $query = "SELECT * FROM view_pengunjung WHERE username='$username'";

    $data = query($query);

    return mysqli_fetch_assoc($data);

}


function updateUserDanPengunjung($data)
{
    // Ambil data dari array $data
    $id_user = $data['id_user'];
    $username = $data['username'];
    $nama = $data['nama'];
    $role = $data['role'];
    $no_induk = $data['no_induk'];
    $tahun_masuk = $data['tahun_masuk'];
    $kelas = $data['kelas'];
    $alamat = $data['alamat'];
    $fileLoc = $data['fileLoc'];
    $id_user_pengedit = $data['id_user_pengedit'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL update_user_dan_pengunjung(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "issssssssi", 
            $id_user,  // integer
            $username,  // string
            $nama,      // string
            $role,      // string
            $no_induk,  // string
            $tahun_masuk,  // integer (YEAR)
            $kelas,     // string
            $alamat,    // string
            $fileLoc,   // string
            $id_user_pengedit  // integer
        );

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, kembalikan 1
            $stmt->close();
            return 1;
        } else {
            // Jika query gagal, kembalikan 0
            $stmt->close();
            return 0;
        }
    } else {
        // Jika gagal mempersiapkan statement
        return 0;
    }
}

function updatePassword($username, $new_password)
{
    $conn = conn();
    // Gunakan query untuk mengupdate password di database
    $query = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("ss", $new_password, $username);
        return $stmt->execute(); // Eksekusi query untuk mengupdate password
    }
    return false; // Jika query gagal
}







?>