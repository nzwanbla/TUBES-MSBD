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


function getDataBooks($limit = null)
{
    $query = "SELECT * FROM view_katalog_buku ORDER BY rating" ;

    if ($limit) {
        $query .= " LIMIT $limit";
    }

    $data = query($query);

    return mysqli_fetch_all($data, MYSQLI_ASSOC);
}

function getDetailBook($id)
{
    $query = "SELECT * FROM view_katalog_buku WHERE id_buku='$id'";

    $data = query($query);

    return mysqli_fetch_assoc($data);
}

function getReviewBook($id)
{
    $query = "SELECT * FROM view_ulasan_buku WHERE id_buku='$id'";

    $data = query($query);

    return ($data);
}

function getCountReview($id)
{
    $query = "SELECT COUNT(id_ulasan_buku) AS jumlah_ulasan FROM view_ulasan_buku WHERE id_buku='$id'";

    $data = query($query);

    return mysqli_fetch_assoc($data);
}

function getCountPeminjaman($id)
{
    $query = "SELECT 
                    eb.id_buku, 
                    COALESCE(COUNT(pb.id_peminjaman_buku), 0) AS jumlah_peminjaman
                FROM 
                    eksemplar_buku eb
                LEFT JOIN 
                    peminjaman_buku pb ON eb.id_eksemplar_buku = pb.id_eksemplar_buku
                JOIN 
                    buku b ON eb.id_buku = b.id_buku
                WHERE 
                    eb.id_buku = '$id'  -- Ganti dengan id_buku yang diinginkan
                GROUP BY 
                    eb.id_buku";


    $data = query($query);

    return mysqli_fetch_assoc($data);
}

function getGenreBook($id)
{
    $query = "SELECT * FROM view_genre_buku WHERE id_buku='$id'";

    $data = query($query);

    return ($data);
}

function getDataEksemplar()
{
    $query = "SELECT * FROM view_eksemplar_buku ORDER BY id_eksemplar_buku DESC";

    $data = query($query);

    return ($data);

}

function getDataReview()
{
    $query = "SELECT * FROM view_ulasan_buku ORDER BY waktu_ulasan DESC";

    $data = query($query);

    return ($data);
}




?>