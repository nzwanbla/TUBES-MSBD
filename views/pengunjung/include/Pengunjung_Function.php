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

    // Siapkan query untuk kedua tabel
    $query1 = "UPDATE users SET foto_profil = ? WHERE id_user = ?";
    $query2 = "UPDATE pengunjung SET alamat = ? WHERE id_user = ?";

    // Mulai transaksi untuk memastikan kedua operasi dilakukan bersama
    $conn->begin_transaction();

    try {
        // Siapkan prepared statement untuk query pertama
        $stmt1 = $conn->prepare($query1);
        if (!$stmt1) {
            throw new Exception("Gagal menyiapkan statement untuk query1: " . $conn->error);
        }
        $stmt1->bind_param("si", $fileLoc, $id_user);
        if (!$stmt1->execute()) {
            throw new Exception("Gagal menjalankan query1: " . $stmt1->error);
        }
        $stmt1->close();

        // Siapkan prepared statement untuk query kedua
        $stmt2 = $conn->prepare($query2);
        if (!$stmt2) {
            throw new Exception("Gagal menyiapkan statement untuk query2: " . $conn->error);
        }
        $stmt2->bind_param("si", $alamat, $id_user);
        if (!$stmt2->execute()) {
            throw new Exception("Gagal menjalankan query2: " . $stmt2->error);
        }
        $stmt2->close();

        // Commit transaksi jika kedua query berhasil
        $conn->commit();
        return 1; // Berhasil
    } catch (Exception $e) {
        // Rollback transaksi jika salah satu query gagal
        $conn->rollback();
        error_log($e->getMessage());
        return 0; // Gagal
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


function getDataBooks()
{
    $query = "SELECT * FROM view_katalog_buku";

    $data = query($query);

    return mysqli_fetch_all($data, MYSQLI_ASSOC);
}

function getDataBooksLim($limit)
{
    $query = "SELECT * FROM view_katalog_buku WHERE jenis_buku = 'NON Paket Pelajaran' ORDER BY jumlah_pemberi_rating DESC LIMIT $limit";

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

function getDataPeminjaman($id, $jenis_buku)
{
    $query = "SELECT 
                vpb.id_peminjaman_buku,
                vpb.id_eksemplar_buku,
                vpb.id_user,
                vpb.no_induk,
                vpb.nama_user,
                vpb.judul_buku,
                vpb.jenis_buku,
                vpb.kelas,
                vpb.nama_petugas,
                vpb.waktu_peminjaman,
                vpb.waktu_pengembalian,
                vpb.perpanjangan,
                db.besaran_denda AS denda,
                db.keterangan,
                rpb.status
            FROM 
                view_peminjaman_buku vpb
            LEFT JOIN 
                denda_buku db ON vpb.id_peminjaman_buku = db.id_peminjaman_buku
            LEFT JOIN 
                request_perpanjangan_buku rpb ON vpb.id_peminjaman_buku = rpb.id_peminjaman_buku
            WHERE 
                vpb.id_user = $id
                AND vpb.jenis_buku = '$jenis_buku' ";

    $data = query($query);

    return ($data);
}




?>