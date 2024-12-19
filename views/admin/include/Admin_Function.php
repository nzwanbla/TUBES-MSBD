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
    $query = "SELECT * FROM users WHERE username='$username'";

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
    $fileLoc = $data['fileLoc'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query 
    $query = "UPDATE users SET username = ?, nama = ?, role = ?, foto_profil = ? WHERE id_user = ?";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "ssssi", 
            $username,  // string
            $nama,      // string
            $role,      // string
            $fileLoc,   // string
            $id_user  // integer
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

function getIdGenreBook($id)
{
    $query = "SELECT id_genre FROM view_genre_buku WHERE id_buku='$id'";

    $data = query($query);

    $genres = [];
    while ($row = $data->fetch_assoc()) {
        $genres[] = $row['id_genre']; // Hanya ambil id_genre
    }
    return $genres;
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

function getDataGenre()
{
    $query = "SELECT * FROM genre WHERE id_genre != 1";

    $data = query($query);

    return ($data);
}

function inputBuku($data)
{
    // Ambil data dari array $data
    $judul = $data['judul'];
    $penulis = $data['penulis'];
    $jenis_buku = $data['jenis_buku'];
    $isbn = $data['isbn'];
    $tahun_terbit = $data['tahun_terbit'];
    $penerbit = $data['penerbit'];
    $foto_buku = $data['foto_buku'];
    $sinopsis = $data['sinopsis'];
    $id_genres = $data['genre'];  // ID genre, bisa lebih dari satu (array atau string yang dipisahkan koma)
    $jumlah_eksemplar = $data['jumlah_eksemplar'];
    $lokasi_rak = $data['lokasi_rak'];
    $id_user_penginput = $data['id_user_penginput'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL tambah_buku_dan_detail(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "sssssssssiss", 
            $judul,       // string
            $penulis,     // string
            $jenis_buku,  // string ('Paket Pelajaran' atau 'Non Paket Pelajaran')
            $isbn,        // string (ISBN)
            $tahun_terbit,// integer (YEAR)
            $penerbit,    // string
            $foto_buku,   // string (lokasi file gambar buku)
            $sinopsis,    // text
            $id_genres,   // string (ID genre buku, bisa dipisahkan koma)
            $jumlah_eksemplar, // integer
            $lokasi_rak,  // string
            $id_user_penginput // integer (ID user yang menambahkan buku)
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

function updateBuku($data)
{
    // Ambil data dari array $data
    $id_buku = $data['id_buku'];
    $judul = $data['judul'];
    $penulis = $data['penulis'];
    $jenis_buku = $data['jenis_buku'];
    $isbn = $data['isbn'];
    $tahun_terbit = $data['tahun_terbit'];
    $penerbit = $data['penerbit'];
    $foto_buku = $data['foto_buku'];
    $sinopsis = $data['sinopsis'];
    $id_genres = $data['genre'];  // ID genre, bisa lebih dari satu (array atau string yang dipisahkan koma)
    $id_user_penginput = $data['id_user_penginput'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL update_buku_dan_detail(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "isssssssssi", 
            $id_buku,
            $judul,       // string
            $penulis,     // string
            $jenis_buku,  // string ('Paket Pelajaran' atau 'Non Paket Pelajaran')
            $isbn,        // string (ISBN)
            $tahun_terbit,// integer (YEAR)
            $penerbit,    // string
            $foto_buku,   // string (lokasi file gambar buku)
            $sinopsis,    // text
            $id_genres,   // string (ID genre buku, bisa dipisahkan koma)
            $id_user_penginput // integer (ID user yang menambahkan buku)
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

function inputEksemplar($data)
{
    $id_buku = $data['id_buku'];
    $jumlah_eksemplar = $data['jumlah_eksemplar'];
    $lokasi_rak = $data['lokasi_rak'];
    $id_user_penginput = $data['id_user_penginput'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL tambah_eksemplar_buku(?, ?, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "iisi", 
            $id_buku,   // string (ID genre buku, bisa dipisahkan koma)
            $jumlah_eksemplar, // integer
            $lokasi_rak,  // string
            $id_user_penginput // integer (ID user yang menambahkan buku)
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

function getDataPetugas()
{
    $query = "SELECT * FROM users WHERE role = 'Petugas' ORDER BY nama ";

    $data = query($query);

    return ($data);
}

function inputPetugas($data)
{
    // Extracting input data
    $username = $data['username'];
    $nama = $data['nama'];
    $role = $data['role'];
    $password = $data['password']; // This should be hashed before passing to the procedure
    $foto_profil = $data['foto_profil']; // You might use this for storing profile picture, but not in the procedure
    $id_user_penginput = $data['id_user_penginput'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL tambah_user_dan_log(?, ?, ?, ?, NULL, NULL, NULL, NULL, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {
        
        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "sssssi", // s for string
            $username,  // p_username
            $password,  // p_password (hashed password)
            $nama,      // p_nama
            $role,      // p_role
            $foto_profil,
            $id_user_penginput  // p_id_user_penginput
        );

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, kembalikan 1
            $stmt->close();
            return 1;
        } else {
            // Jika query gagal, kembalikan error
            $stmt->close();
            return 0;
        }
    } else {
        // Jika query preparation gagal, kembalikan error
        return 0;
    }
}

function getDataSiswa($angkatan)
{
    $query = "SELECT * FROM view_pengunjung WHERE BINARY kelas LIKE '$angkatan-%' ORDER BY nama_pengunjung";

    $data = query($query);

    return ($data);
}

function inputSiswa($data)
{
    // Extracting input data
    $username = $data['username'];
    $nama = $data['nama'];
    $role = $data['role'];
    $password = $data['password']; // This should be hashed before passing to the procedure
    $no_induk = $data['username'];
    $tahun_masuk = $data['tahun_masuk'];
    $kelas = $data['kelas'];
    $id_user_penginput = $data['id_user_penginput'];
    $foto_profil = $data['foto_profil']; // Path foto profil

    // Default value for alamat
    $alamat = NULL;

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL tambah_user_dan_log(?, ?, ?, ?, ?, ?, ?, NULL, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "sssssissi", // s for string, i for integer
            $username,  // p_username
            $password,  // p_password (hashed password)
            $nama,      // p_nama
            $role,      // p_role
            $no_induk,  // p_no_induk
            $tahun_masuk, // p_tahun_masuk
            $kelas,     // p_kelas
            $foto_profil, // p_foto_profil
            $id_user_penginput  // p_id_user_penginput
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
        // Jika query preparation gagal, kembalikan 0
        return 0;
    }
}

function getDataGuru()
{
    $query = "SELECT * FROM view_pengunjung WHERE kelas_asli IS NULL AND tahun_masuk IS NULL ORDER BY nama_pengunjung";

    $data = query($query);

    return ($data);
}

function inputGuru($data)
{
    // Extracting input data
    $username = $data['username'];
    $nama = $data['nama'];
    $role = $data['role'];
    $password = $data['password']; // This should be hashed before passing to the procedure
    $no_induk = $data['username'];
    $id_user_penginput = $data['id_user_penginput'];
    $foto_profil = $data['foto_profil']; // Path foto profil

    // Default value for alamat
    $alamat = NULL;

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL tambah_user_dan_log(?, ?, ?, ?, ?, NULL, NULL, NULL, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "ssssssi", // s for string, i for integer
            $username,  // p_username
            $password,  // p_password (hashed password)
            $nama,      // p_nama
            $role,      // p_role
            $no_induk,  // p_no_induk
            $foto_profil, // p_foto_profil
            $id_user_penginput  // p_id_user_penginput
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
        // Jika query preparation gagal, kembalikan 0
        return 0;
    }
}

function getDataPeminjaman($jenis)
{
    $query = "SELECT * FROM view_peminjaman_buku WHERE jenis_buku = '$jenis' ";

    $data = query($query);

    return ($data);
}

function inputPeminjaman($data)
{
    // Extracting input data

    $id_user = $data['id_user']; // This should be hashed before passing to the procedure
    $id_eksemplar_buku = $data['id_eksemplar_buku'];
    $id_petugas = $data['id_petugas'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL peminjaman_buku(?, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "iii", // s for string, i for integer  
            $id_eksemplar_buku,  
            $id_user,
            $id_petugas  
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
        // Jika query preparation gagal, kembalikan 0
        return 0;
    }
}

function inputPengembalian($data)
{
    // Extracting input data

    $id_peminjaman = $data['id_peminjaman'];
    $id_petugas = $data['id_petugas'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL pengembalian_buku(?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "ii", // s for string, i for integer  
            $id_peminjaman,  
            $id_petugas  
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
        // Jika query preparation gagal, kembalikan 0
        return 0;
    }
}

function inputDenda($data)
{
    // Extracting input data

    $id_peminjaman = $data['id_peminjaman_buku'];
    $id_user = $data['id_user'];
    $keterangan = $data['keterangan'];
    $hari_telat = $data['hari_telat'];
    $denda_harian = $data['denda_per_hari'];
    $denda = $data['denda'];
    $id_petugas = $data['id_petugas'];

    // Koneksi ke database
    $conn = conn(); // Fungsi untuk mendapatkan koneksi ke database

    // Siapkan query untuk memanggil stored procedure dengan parameter
    $query = "CALL denda_buku(?, ?, ?, ?, ?, ?)";

    // Siapkan prepared statement
    if ($stmt = $conn->prepare($query)) {

        // Mengikat parameter dengan tipe data yang sesuai
        $stmt->bind_param(
            "iisiii", // s for string, i for integer  
            $id_peminjaman,
            $id_user,
            $keterangan,
            $hari_telat,
            $denda_harian,
            $denda  
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
        // Jika query preparation gagal, kembalikan 0
        return 0;
    }
}

function getDataDenda()
{
    $query = "SELECT * FROM view_denda_buku";

    $data = query($query);

    return ($data);
}

function getDataRequest()
{
    $query = "SELECT * FROM view_request_perpanjangan_buku";

    $data = query($query);

    return ($data);
}

?>