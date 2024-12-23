-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 05:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtubesmsbd`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `approve_perpanjangan` (IN `p_id_request` INT, IN `p_id_petugas` INT)   BEGIN
    DECLARE v_id_peminjaman_buku INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    SELECT id_peminjaman_buku
    INTO v_id_peminjaman_buku
    FROM request_perpanjangan_buku
    WHERE id_request = p_id_request;

    UPDATE request_perpanjangan_buku
    SET status = 'Diterima'
    WHERE id_request = p_id_request;

    UPDATE peminjaman_buku
    SET perpanjangan = TRUE
    WHERE id_peminjaman_buku = v_id_peminjaman_buku;

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `denda_buku` (IN `p_id_peminjaman_buku` INT, IN `p_id_user` INT, IN `p_keterangan` VARCHAR(255), IN `p_hari_telat` INT, IN `p_denda_per_hari` INT, IN `p_besaran_denda` INT)   BEGIN
    DECLARE v_total_denda INT;
    DECLARE v_id_eksemplar_buku INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;
	
    SELECT id_eksemplar_buku
    INTO v_id_eksemplar_buku
    FROM peminjaman_buku
    WHERE id_peminjaman_buku = p_id_peminjaman_buku;

	
	IF p_keterangan = 'Telat' THEN
        SET v_total_denda = p_hari_telat * p_denda_per_hari;
	IF v_total_denda > 30000 THEN
		SET v_total_denda = 30000;
	END IF;
    ELSE
        SET v_total_denda = p_besaran_denda;
		
		IF p_keterangan = 'Hilang' THEN
			UPDATE eksemplar_buku
			SET status = 'Hilang'
			WHERE id_eksemplar_buku = v_id_eksemplar_buku;
		ELSE 
			UPDATE eksemplar_buku
			SET status = 'Rusak'
			WHERE id_eksemplar_buku = v_id_eksemplar_buku;
		END IF;
    END IF;

    INSERT INTO denda_buku (id_peminjaman_buku, id_user, besaran_denda, keterangan)
    VALUES (p_id_peminjaman_buku, p_id_user, v_total_denda, p_keterangan);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `peminjaman_buku` (IN `p_id_eksemplar_buku` INT, IN `p_id_user` INT, IN `p_id_petugas` INT)   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    INSERT INTO peminjaman_buku (id_eksemplar_buku, id_user, id_petugas)
    VALUES (p_id_eksemplar_buku, p_id_user, p_id_petugas);
	
    UPDATE eksemplar_buku
    SET status = 'Dipinjamkan'
    WHERE id_eksemplar_buku = p_id_eksemplar_buku;

    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
    VALUES (
        p_id_petugas,
        'peminjaman_buku',
        'INSERT',
        JSON_OBJECT(
            'id_eksemplar_buku', p_id_eksemplar_buku,
            'id_user', p_id_user,
            'id_petugas', p_id_petugas
        )
    );

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pengembalian_buku` (IN `p_id_peminjaman_buku` INT, IN `p_id_petugas` INT)   BEGIN
    DECLARE v_id_eksemplar_buku INT;
    DECLARE v_id_user INT;
    DECLARE v_perpanjangan BOOLEAN;
    DECLARE v_tanggal_peminjaman DATETIME;
    DECLARE v_hari_telat INT;
    DECLARE v_batas_hari INT;
    DECLARE v_jenis_buku ENUM('Paket Pelajaran', 'NON Paket Pelajaran');

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    SELECT id_eksemplar_buku, id_user, waktu_peminjaman, perpanjangan
    INTO v_id_eksemplar_buku, v_id_user, v_tanggal_peminjaman, v_perpanjangan
    FROM peminjaman_buku
    WHERE id_peminjaman_buku = p_id_peminjaman_buku;

    IF v_perpanjangan THEN
        SET v_batas_hari = 9;
    ELSE
        SET v_batas_hari = 6;
    END IF;

    SELECT b.jenis_buku
    INTO v_jenis_buku
    FROM buku b
    JOIN eksemplar_buku eb ON b.id_buku = eb.id_buku
    WHERE eb.id_eksemplar_buku = v_id_eksemplar_buku;

    SET v_hari_telat = DATEDIFF(CURRENT_TIMESTAMP, v_tanggal_peminjaman) - v_batas_hari;

    IF v_hari_telat > 0 AND v_jenis_buku = 'NON Paket Pelajaran' THEN
        CALL denda_buku(
            p_id_peminjaman_buku,
            v_id_user,
            'Telat',
            v_hari_telat,
            500,
            NULL
        );
    END IF;

    UPDATE eksemplar_buku
    SET status = 'Tersedia'
    WHERE id_eksemplar_buku = v_id_eksemplar_buku;

    UPDATE peminjaman_buku
    SET waktu_pengembalian = CURRENT_TIMESTAMP
    WHERE id_peminjaman_buku = p_id_peminjaman_buku;

    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
    VALUES (
        p_id_petugas,
        'peminjaman_buku',
        'UPDATE',
        JSON_OBJECT(
            'id_peminjaman_buku', p_id_peminjaman_buku,
            'waktu_pengembalian', CURRENT_TIMESTAMP
        )
    );

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `request_perpanjangan` (IN `p_id_peminjaman_buku` INT, IN `p_id_user` INT)   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    INSERT INTO request_perpanjangan_buku (id_peminjaman_buku, id_user, tanggal_request, status)
    VALUES (p_id_peminjaman_buku, p_id_user, CURRENT_TIMESTAMP, 'Pending');

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_buku_dan_detail` (IN `p_judul` VARCHAR(50), IN `p_penulis` VARCHAR(50), IN `p_jenis_buku` ENUM('Paket Pelajaran','NON Paket Pelajaran'), IN `p_isbn` VARCHAR(25), IN `p_tahun_terbit` YEAR, IN `p_penerbit` VARCHAR(40), IN `p_foto_buku` VARCHAR(255), IN `p_sinopsis` TEXT, IN `p_id_genres` VARCHAR(50), IN `p_jumlah_eksemplar` INT, IN `p_lokasi_rak` VARCHAR(15), IN `p_id_user_penginput` INT)   BEGIN
    DECLARE v_id_buku INT;      

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    INSERT INTO buku (judul, penulis, jenis_buku)
    VALUES (p_judul, p_penulis, p_jenis_buku);
    SET v_id_buku = LAST_INSERT_ID();


    INSERT INTO detail_buku (id_buku, ISBN, tahun_terbit, penerbit, sinopsis, foto_buku)
    VALUES (v_id_buku, p_isbn, p_tahun_terbit, p_penerbit, p_sinopsis, p_foto_buku);

    CALL tambah_genre_buku(v_id_buku, p_id_genres);

    CALL tambah_eksemplar_buku(v_id_buku, p_jumlah_eksemplar, p_lokasi_rak, p_id_user_penginput);

    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
	VALUES (
		p_id_user_penginput,
		'buku dan detail_buku',
		'INSERT',
		JSON_OBJECT(
			'id_buku', v_id_buku,
			'judul', p_judul,
			'penulis', p_penulis,
			'isbn', p_isbn,
			'penerbit', p_penerbit,
			'tahun terbit', p_tahun_terbit,
			'Banyaknya Eksemplar', p_jumlah_eksemplar,
			'lokasi_rak', p_lokasi_rak,
			'status', 'Tersedia'
		)
	);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_eksemplar_buku` (IN `p_id_buku` INT, IN `p_jumlah_eksemplar` INT, IN `p_lokasi_rak` VARCHAR(15), IN `p_id_user_penginput` INT)   BEGIN
    DECLARE v_id_eksemplar INT;
    DECLARE i INT DEFAULT 0;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    WHILE i < p_jumlah_eksemplar DO
        INSERT INTO eksemplar_buku (id_buku, lokasi_rak, status)
        VALUES (p_id_buku, p_lokasi_rak, 'Tersedia');

        SET i = i + 1;
    END WHILE;

    SET v_id_eksemplar = LAST_INSERT_ID();

    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
    VALUES (
        p_id_user_penginput,
        'eksemplar_buku',
        'INSERT',
        JSON_OBJECT(
            'id_eksemplar', v_id_eksemplar,
            'id_buku', p_id_buku,
            'Banyaknya Eksemplar', p_jumlah_eksemplar,
            'lokasi_rak', p_lokasi_rak,
            'status', 'Tersedia'
        )
    );

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_genre` (IN `p_nama_genre` VARCHAR(15))   BEGIN
    DECLARE v_id_genre INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    INSERT INTO genre (nama_genre)
    VALUES (p_nama_genre);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_genre_buku` (IN `p_id_buku` INT, IN `p_id_genres` TEXT)   BEGIN
    DECLARE v_id_genre INT;
    DECLARE v_position INT;
    DECLARE v_genres TEXT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    SET v_genres = p_id_genres;

    WHILE CHAR_LENGTH(v_genres) > 0 DO
        SET v_position = LOCATE(',', v_genres);

        IF v_position = 0 THEN
            SET v_id_genre = v_genres;
            SET v_genres = '';
        ELSE
            SET v_id_genre = SUBSTRING(v_genres, 1, v_position - 1);
            SET v_genres = SUBSTRING(v_genres, v_position + 1);
        END IF;

        INSERT INTO genre_buku (id_genre, id_buku)
        VALUES (v_id_genre, p_id_buku);
    END WHILE;

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_user_dan_log` (IN `p_username` VARCHAR(20), IN `p_password` VARCHAR(255), IN `p_nama` VARCHAR(40), IN `p_role` ENUM('Admin','Petugas','Pengunjung','Non aktif'), IN `p_no_induk` VARCHAR(20), IN `p_tahun_masuk` YEAR, IN `p_kelas` VARCHAR(10), IN `p_alamat` TEXT, IN `p_foto_profil` TEXT, IN `p_id_user_penginput` INT)   BEGIN
    DECLARE p_id_user_baru INT;
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    INSERT INTO users (username, password, nama, role, foto_profil)
    VALUES (p_username, p_password, p_nama, p_role, p_foto_profil);

    SET p_id_user_baru = LAST_INSERT_ID();

    IF p_role = 'Pengunjung' THEN
        INSERT INTO pengunjung (id_user, no_induk, tahun_masuk, kelas, alamat)
        VALUES (p_id_user_baru, p_no_induk, p_tahun_masuk, p_kelas, p_alamat);
    END IF;

    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
    VALUES (
        p_id_user_penginput,
        'users',
        'INSERT',
        JSON_OBJECT(
            'id_user', p_id_user_baru,
            'username', p_username,
            'nama', p_nama,
            'role', p_role
        )
    );

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ulasan_buku` (IN `p_id_peminjaman_buku` INT, IN `p_id_buku` INT, IN `p_rating` INT, IN `p_komentar` TEXT, IN `p_id_user` INT)   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    IF p_rating < 0 OR p_rating > 5 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Rating harus berada dalam rentang 1-5.';
    END IF;

    START TRANSACTION;

    INSERT INTO ulasan_buku (id_peminjaman, id_buku, rating, komentar, waktu_ulasan)
    VALUES (p_id_peminjaman_buku, p_id_buku, p_rating, p_komentar, CURRENT_TIMESTAMP);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_buku_dan_detail` (IN `p_id_buku` INT, IN `p_judul` VARCHAR(50), IN `p_penulis` VARCHAR(50), IN `p_jenis_buku` ENUM('Paket Pelajaran','NON Paket Pelajaran'), IN `p_isbn` VARCHAR(25), IN `p_tahun_terbit` YEAR, IN `p_penerbit` VARCHAR(40), IN `p_foto_buku` VARCHAR(255), IN `p_sinopsis` TEXT, IN `p_id_genres` VARCHAR(50), IN `p_id_user_penginput` INT)   BEGIN
    DECLARE v_old_judul VARCHAR(50);
    DECLARE v_old_penulis VARCHAR(50);
    DECLARE v_old_jenis_buku VARCHAR(50);
    DECLARE v_old_isbn VARCHAR(25);
    DECLARE v_old_tahun_terbit YEAR;
    DECLARE v_old_penerbit VARCHAR(40);
    DECLARE v_old_foto_buku VARCHAR(255);
    DECLARE v_old_sinopsis TEXT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    SELECT judul, penulis, jenis_buku, ISBN, tahun_terbit, penerbit, foto_buku, sinopsis
    INTO v_old_judul, v_old_penulis, v_old_jenis_buku, v_old_isbn, v_old_tahun_terbit, v_old_penerbit, v_old_foto_buku, v_old_sinopsis
    FROM view_katalog_buku
    WHERE id_buku = p_id_buku;

    UPDATE buku
    SET judul = p_judul,
        penulis = p_penulis,
        jenis_buku = p_jenis_buku
    WHERE id_buku = p_id_buku;

    UPDATE detail_buku
    SET ISBN = p_isbn,
        tahun_terbit = p_tahun_terbit,
        penerbit = p_penerbit,
        sinopsis = p_sinopsis,
        foto_buku = p_foto_buku
    WHERE id_buku = p_id_buku;

    DELETE FROM genre_buku WHERE id_buku = p_id_buku;

    CALL tambah_genre_buku(p_id_buku, p_id_genres);

    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_lama, nilai_baru)
    VALUES (
        p_id_user_penginput, 
        'buku dan detail_buku', 
        'UPDATE', 
        JSON_OBJECT(
            'id_buku', p_id_buku,
            'judul', v_old_judul,
            'penulis', v_old_penulis,
            'jenis_buku', v_old_jenis_buku,
            'isbn', v_old_isbn,
            'penerbit', v_old_penerbit,
            'tahun_terbit', v_old_tahun_terbit,
            'sinopsis', v_old_sinopsis,
            'foto_buku', v_old_foto_buku
        ),
        JSON_OBJECT(
            'id_buku', p_id_buku,
            'judul', p_judul,
            'penulis', p_penulis,
            'jenis_buku', p_jenis_buku,
            'isbn', p_isbn,
            'penerbit', p_penerbit,
            'tahun_terbit', p_tahun_terbit,
            'sinopsis', p_sinopsis,
            'foto_buku', p_foto_buku
        )
    );

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_dan_pengunjung` (IN `p_id_user` INT, IN `p_username` VARCHAR(30), IN `p_password` VARCHAR(150), IN `p_nama` VARCHAR(40), IN `p_role` ENUM('Admin','Petugas','Pengunjung','Non aktif'), IN `p_no_induk` VARCHAR(20), IN `p_tahun_masuk` YEAR, IN `p_kelas` VARCHAR(10), IN `p_alamat` TEXT, IN `p_path_foto_profil` VARCHAR(255))   BEGIN

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Terjadi kesalahan, transaksi dibatalkan.';
    END;

    START TRANSACTION;

    IF p_role = 'Pengunjung' THEN

        UPDATE users
    SET username = p_username,
        password = p_password,
        nama = p_nama,
        role = p_role,
        foto_profil = p_path_foto_profil
    WHERE id_user = p_id_user;

        UPDATE pengunjung
        SET no_induk = p_no_induk,
            tahun_masuk = p_tahun_masuk,
            kelas = p_kelas,
            alamat = p_alamat
        WHERE id_user = p_id_user;

    ELSE
        UPDATE users
        SET username = p_username,
            nama = p_nama,
            role = p_role,
            foto_profil = p_path_foto_profil
        WHERE id_user = p_id_user;

    END IF;
    COMMIT;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_kelas_siswa` (`p_tahun_masuk` YEAR, `p_kelas` VARCHAR(10)) RETURNS VARCHAR(50) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE v_kelas VARCHAR(50);
    DECLARE v_selisih_tahun INT;
    DECLARE v_bulan INT;

    IF p_tahun_masuk IS NULL THEN
        SET v_kelas = 'Guru';
        RETURN v_kelas;
    END IF;

    SET v_selisih_tahun = YEAR(CURRENT_DATE) - p_tahun_masuk;
    SET v_bulan = MONTH(CURRENT_DATE);

    IF v_selisih_tahun = 0 THEN
        IF v_bulan >= 7 THEN
            SET v_kelas = CONCAT('X-', p_kelas);
        ELSE
            SET v_kelas = 'Belum Masuk Kelas';
        END IF;
    ELSEIF v_selisih_tahun = 1 THEN
        IF v_bulan >= 7 THEN
            SET v_kelas = CONCAT('XI-', p_kelas);
        ELSE
            SET v_kelas = CONCAT('X-', p_kelas);
        END IF;
    ELSEIF v_selisih_tahun = 2 THEN
        IF v_bulan >= 7 THEN
            SET v_kelas = CONCAT('XII-', p_kelas);
        ELSE
            SET v_kelas = CONCAT('XI-', p_kelas);
        END IF;
    ELSE
        SET v_kelas = 'Alumni';
    END IF;

    RETURN v_kelas;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `hitung_denda_telat` (`id_peminjaman_buku` INT) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE jenis_buku ENUM('Paket Pelajaran', 'NON Paket Pelajaran');
    DECLARE tanggal_peminjaman DATE;
    DECLARE tanggal_pengembalian DATE;
    DECLARE perpanjangan BOOLEAN;
    DECLARE hari_terlambat INT;
    DECLARE denda INT;
    DECLARE denda_maksimum INT DEFAULT 30000;
    DECLARE batas_waktu INT DEFAULT 6; -- Default 6 hari tanpa perpanjangan
    DECLARE denda_per_hari INT DEFAULT 500; -- Default denda per hari

    -- Ambil data dari tabel peminjaman_buku berdasarkan id_peminjaman_buku
    SELECT 
        b.jenis_buku, 
        p.waktu_peminjaman, 
        p.waktu_pengembalian, 
        p.perpanjangan
    INTO 
        jenis_buku, 
        tanggal_peminjaman, 
        tanggal_pengembalian, 
        perpanjangan
    FROM peminjaman_buku p
    JOIN eksemplar_buku e ON e.id_eksemplar_buku = p.id_eksemplar_buku
    JOIN buku b ON b.id_buku = e.id_buku
    WHERE p.id_peminjaman_buku = id_peminjaman_buku;

	IF tanggal_pengembalian IS NULL THEN
        SET tanggal_pengembalian = CURRENT_DATE;
    END IF;


    -- Jika jenis buku adalah 'Paket Pelajaran', tidak ada denda
    IF jenis_buku = 'Paket Pelajaran' THEN
        RETURN 0;
    END IF;

    -- Tentukan batas waktu pengembalian berdasarkan apakah ada perpanjangan
    IF perpanjangan THEN
        SET batas_waktu = 9; -- Jika perpanjangan, batas waktu jadi 9 hari
    END IF;

    -- Hitung hari terlambat
    SET hari_terlambat = DATEDIFF(tanggal_pengembalian, tanggal_peminjaman) - batas_waktu;

    -- Jika tidak ada keterlambatan, maka tidak ada denda
    IF hari_terlambat <= 0 THEN
        RETURN 0;
    END IF;

    -- Hitung denda
    SET denda = hari_terlambat * denda_per_hari;

    -- Pastikan denda tidak melebihi maksimum
    IF denda > denda_maksimum THEN
        SET denda = denda_maksimum;
    END IF;

    RETURN denda;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `jenis_buku` enum('Paket Pelajaran','NON Paket Pelajaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `denda_buku`
--

CREATE TABLE `denda_buku` (
  `id_denda_buku` int(11) NOT NULL,
  `id_peminjaman_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `besaran_denda` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `denda_buku`
--
DELIMITER $$
CREATE TRIGGER `after_insert_denda_buku` AFTER INSERT ON `denda_buku` FOR EACH ROW BEGIN
    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_baru)
    VALUES (
		NEW.id_user,
        'denda_buku', 
        'INSERT', 
        JSON_OBJECT(
            'id_denda_buku', NEW.id_denda_buku,
            'id_peminjaman_buku', NEW.id_peminjaman_buku,
            'id_user', NEW.id_user,
            'besaran_denda', NEW.besaran_denda,
            'keterangan', NEW.keterangan
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_denda_buku` AFTER UPDATE ON `denda_buku` FOR EACH ROW BEGIN
    INSERT INTO log_aktivitas (id_user, nama_tabel, operasi, nilai_lama ,nilai_baru)
    VALUES (
		NEW.id_user,
        'denda_buku', 
        'UPDATE', 
        JSON_OBJECT(
            'id_denda_buku', OLD.id_denda_buku,
            'id_peminjaman_buku', OLD.id_peminjaman_buku,
            'id_user', OLD.id_user,
            'besaran_denda', OLD.besaran_denda,
            'keterangan', OLD.keterangan
        ),
        JSON_OBJECT(
            'id_denda_buku', NEW.id_denda_buku,
            'id_peminjaman_buku', NEW.id_peminjaman_buku,
            'id_user', NEW.id_user,
            'besaran_denda', NEW.besaran_denda,
            'keterangan', NEW.keterangan
        )
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_buku`
--

CREATE TABLE `detail_buku` (
  `id_buku` int(11) NOT NULL,
  `ISBN` varchar(25) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `penerbit` varchar(40) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `foto_buku` varchar(255) DEFAULT '../../assets/images/default_book.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eksemplar_buku`
--

CREATE TABLE `eksemplar_buku` (
  `id_eksemplar_buku` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `lokasi_rak` varchar(15) DEFAULT NULL,
  `status` enum('Tersedia','Dipinjamkan','Hilang','Rusak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `nama_genre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `genre` (`id_genre`, `nama_genre`) VALUES
(1, '-'),
(2, 'Fiksi'),
(3, 'Non-Fiksi'),
(4, 'Fantasi'),
(5, 'Petualangan'),
(6, 'Misteri'),
(7, 'Romantis'),
(8, 'Horor'),
(9, 'Thriller'),
(10, 'Fiksi Ilmiah'),
(11, 'Sejarah'),
(12, 'Biografi'),
(13, 'Memoar'),
(14, 'Komedi'),
(15, 'Esai'),
(16, 'Satire'),
(17, 'Parodi'),
(18, 'Self-Help'),
(19, 'Ilmu Pengetahuan'),
(20, 'Filsafat'),
(21, 'Spiritualitas'),
(22, 'True Crime'),
(23, 'Distopia'),
(24, 'Utopia'),
(25, 'Antologi');


-- --------------------------------------------------------

--
-- Table structure for table `genre_buku`
--

CREATE TABLE `genre_buku` (
  `id_genre_buku` int(11) NOT NULL,
  `id_genre` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_tabel` varchar(255) NOT NULL,
  `operasi` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `nilai_lama` varchar(255) DEFAULT NULL,
  `nilai_baru` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `log_aktivitas`
--
DELIMITER $$
CREATE TRIGGER `cannot_delete_log_aktivitas` BEFORE DELETE ON `log_aktivitas` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Penghapusan pada tabel log aktivitas tidak diizinkan.';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cannot_update_log_aktivitas` BEFORE UPDATE ON `log_aktivitas` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Pembaruan pada tabel log aktivitas tidak diizinkan.';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_buku`
--

CREATE TABLE `peminjaman_buku` (
  `id_peminjaman_buku` int(11) NOT NULL,
  `id_eksemplar_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `waktu_peminjaman` datetime DEFAULT current_timestamp(),
  `waktu_pengembalian` datetime DEFAULT NULL,
  `perpanjangan` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_user` int(11) NOT NULL,
  `no_induk` varchar(20) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_perpanjangan_buku`
--

CREATE TABLE `request_perpanjangan_buku` (
  `id_request` int(11) NOT NULL,
  `id_peminjaman_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `waktu_request` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Diterima','Ditolak') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id_ulasan_buku` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text DEFAULT NULL,
  `waktu_ulasan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `role` enum('Admin','Petugas','Pengunjung','Non aktif') NOT NULL,
  `foto_profil` varchar(255) DEFAULT '../../assets/images/profil/default_profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `role`, `foto_profil`) VALUES
(1, 'Admin123', '$2y$10$1D3NqtJBpT0/aCxjCHk0D.vLTZrSy7fdGil.HcpqePLWV2Pg95wAK', 'Admin_Perpus', 'Admin', '../../assets/images/profil/default_profile.jpg'),
(2, '00001234', '$2y$10$MsnXPcSmNYBaSvlGpD3e.O.cIANNhiIMhOyZ/3Nv/RD7meaugL6du', 'Petugas', 'Petugas', '../../assets/images/profil/default_profile.jpg');


-- --------------------------------------------------------

--
-- Stand-in structure for view `view_denda_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_denda_buku` (
`id_denda_buku` int(11)
,`id_peminjaman_buku` int(11)
,`id_eksemplar_buku` int(11)
,`id_user` int(11)
,`no_induk` varchar(20)
,`id_petugas` int(11)
,`nama_user` varchar(40)
,`judul_buku` varchar(50)
,`waktu_peminjaman` datetime
,`waktu_pengembalian` datetime
,`perpanjangan` tinyint(1)
,`jenis_buku` enum('Paket Pelajaran','NON Paket Pelajaran')
,`kelas` varchar(16)
,`besaran_denda` int(11)
,`keterangan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_eksemplar_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_eksemplar_buku` (
`id_eksemplar_buku` int(11)
,`lokasi_rak` varchar(15)
,`status` enum('Tersedia','Dipinjamkan','Hilang','Rusak')
,`id_buku` int(11)
,`judul` varchar(50)
,`penulis` varchar(50)
,`jenis_buku` enum('Paket Pelajaran','NON Paket Pelajaran')
,`ISBN` varchar(25)
,`tahun_terbit` year(4)
,`penerbit` varchar(40)
,`foto_buku` varchar(255)
,`jumlah_peminjaman` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_genre_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_genre_buku` (
`id_buku` int(11)
,`id_genre` int(11)
,`nama_genre` varchar(25)
,`judul` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_katalog_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_katalog_buku` (
`id_buku` int(11)
,`judul` varchar(50)
,`penulis` varchar(50)
,`jenis_buku` enum('Paket Pelajaran','NON Paket Pelajaran')
,`ISBN` varchar(25)
,`tahun_terbit` year(4)
,`penerbit` varchar(40)
,`sinopsis` text
,`lokasi_rak` varchar(15)
,`foto_buku` varchar(255)
,`rating` varchar(14)
,`jumlah_pemberi_rating` bigint(21)
,`jumlah_buku_tersedia` bigint(21)
,`jumlah_eksemplar` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_peminjaman_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_peminjaman_buku` (
`id_peminjaman_buku` int(11)
,`id_eksemplar_buku` int(11)
,`id_user` int(11)
,`no_induk` varchar(20)
,`id_petugas` int(11)
,`nama_user` varchar(40)
,`judul_buku` varchar(50)
,`jenis_buku` enum('Paket Pelajaran','NON Paket Pelajaran')
,`kelas` varchar(16)
,`nama_petugas` varchar(40)
,`waktu_peminjaman` datetime
,`waktu_pengembalian` datetime
,`perpanjangan` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pengunjung`
-- (See below for the actual view)
--
CREATE TABLE `view_pengunjung` (
`id_user` int(11)
,`username` varchar(20)
,`role` enum('Admin','Petugas','Pengunjung','Non aktif')
,`nama_pengunjung` varchar(40)
,`kelas_asli` varchar(10)
,`foto_profil` varchar(255)
,`no_induk` varchar(20)
,`tahun_masuk` year(4)
,`alamat` mediumtext
,`kelas` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_request_perpanjangan_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_request_perpanjangan_buku` (
`id_request` int(11)
,`id_peminjaman_buku` int(11)
,`id_eksemplar_buku` int(11)
,`id_user` int(11)
,`no_induk` varchar(20)
,`id_petugas` int(11)
,`waktu_pengembalian` datetime
,`nama_user` varchar(40)
,`judul_buku` varchar(50)
,`jenis_buku` enum('Paket Pelajaran','NON Paket Pelajaran')
,`kelas` varchar(16)
,`waktu_request` datetime
,`status` enum('Pending','Diterima','Ditolak')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ulasan_buku`
-- (See below for the actual view)
--
CREATE TABLE `view_ulasan_buku` (
`id_user` int(11)
,`nama_user` varchar(40)
,`foto_profil` varchar(255)
,`id_ulasan_buku` int(11)
,`id_peminjaman` int(11)
,`id_buku` int(11)
,`judul` varchar(50)
,`rating` int(11)
,`komentar` text
,`waktu_ulasan` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `view_denda_buku`
--
DROP TABLE IF EXISTS `view_denda_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_denda_buku`  AS SELECT `db`.`id_denda_buku` AS `id_denda_buku`, `pb`.`id_peminjaman_buku` AS `id_peminjaman_buku`, `pb`.`id_eksemplar_buku` AS `id_eksemplar_buku`, `pb`.`id_user` AS `id_user`, `p`.`no_induk` AS `no_induk`, `pb`.`id_petugas` AS `id_petugas`, `u`.`nama` AS `nama_user`, `b`.`judul` AS `judul_buku`, `pb`.`waktu_peminjaman` AS `waktu_peminjaman`, `pb`.`waktu_pengembalian` AS `waktu_pengembalian`, `pb`.`perpanjangan` AS `perpanjangan`, `b`.`jenis_buku` AS `jenis_buku`, CASE WHEN `p`.`tahun_masuk` is null THEN 'Guru' WHEN year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` > 3 THEN 'Alumni' WHEN month(`pb`.`waktu_peminjaman`) < 7 THEN concat(case when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 1 then 'X-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 2 then 'XI-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 3 then 'XII-' end,`p`.`kelas`) WHEN month(`pb`.`waktu_peminjaman`) >= 7 THEN concat(case when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 0 then 'X-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 1 then 'XI-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 2 then 'XII-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 3 then 'Alumni' end,`p`.`kelas`) END AS `kelas`, `db`.`besaran_denda` AS `besaran_denda`, `db`.`keterangan` AS `keterangan` FROM (((((`denda_buku` `db` join `peminjaman_buku` `pb` on(`db`.`id_peminjaman_buku` = `pb`.`id_peminjaman_buku`)) join `users` `u` on(`db`.`id_user` = `u`.`id_user`)) join `eksemplar_buku` `eb` on(`pb`.`id_eksemplar_buku` = `eb`.`id_eksemplar_buku`)) join `buku` `b` on(`eb`.`id_buku` = `b`.`id_buku`)) join `pengunjung` `p` on(`p`.`id_user` = `db`.`id_user`)) ORDER BY `db`.`id_denda_buku` DESC  ;

-- --------------------------------------------------------

--
-- Structure for view `view_eksemplar_buku`
--
DROP TABLE IF EXISTS `view_eksemplar_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_eksemplar_buku`  AS SELECT `eb`.`id_eksemplar_buku` AS `id_eksemplar_buku`, `eb`.`lokasi_rak` AS `lokasi_rak`, `eb`.`status` AS `status`, `b`.`id_buku` AS `id_buku`, `b`.`judul` AS `judul`, `b`.`penulis` AS `penulis`, `b`.`jenis_buku` AS `jenis_buku`, `db`.`ISBN` AS `ISBN`, `db`.`tahun_terbit` AS `tahun_terbit`, `db`.`penerbit` AS `penerbit`, `db`.`foto_buku` AS `foto_buku`, coalesce(count(`pb`.`id_peminjaman_buku`),0) AS `jumlah_peminjaman` FROM (((`eksemplar_buku` `eb` join `buku` `b` on(`eb`.`id_buku` = `b`.`id_buku`)) join `detail_buku` `db` on(`b`.`id_buku` = `db`.`id_buku`)) left join `peminjaman_buku` `pb` on(`eb`.`id_eksemplar_buku` = `pb`.`id_eksemplar_buku`)) GROUP BY `eb`.`id_eksemplar_buku`, `eb`.`lokasi_rak`, `eb`.`status`, `b`.`id_buku`, `b`.`judul`, `b`.`penulis`, `b`.`jenis_buku`, `db`.`ISBN`, `db`.`tahun_terbit`, `db`.`penerbit`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_genre_buku`
--
DROP TABLE IF EXISTS `view_genre_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_genre_buku`  AS SELECT `gb`.`id_buku` AS `id_buku`, `gb`.`id_genre` AS `id_genre`, `g`.`nama_genre` AS `nama_genre`, `b`.`judul` AS `judul` FROM ((`genre_buku` `gb` join `genre` `g` on(`gb`.`id_genre` = `g`.`id_genre`)) join `buku` `b` on(`gb`.`id_buku` = `b`.`id_buku`)) ORDER BY `gb`.`id_buku` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `view_katalog_buku`
--
DROP TABLE IF EXISTS `view_katalog_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_katalog_buku`  AS SELECT `b`.`id_buku` AS `id_buku`, `b`.`judul` AS `judul`, `b`.`penulis` AS `penulis`, `b`.`jenis_buku` AS `jenis_buku`, `db`.`ISBN` AS `ISBN`, `db`.`tahun_terbit` AS `tahun_terbit`, `db`.`penerbit` AS `penerbit`, `db`.`sinopsis` AS `sinopsis`, `eb`.`lokasi_rak` AS `lokasi_rak`, `db`.`foto_buku` AS `foto_buku`, ifnull(round(avg(`ub`.`rating`),1),'Not Rated') AS `rating`, coalesce(count(distinct `ub`.`id_ulasan_buku`),0) AS `jumlah_pemberi_rating`, coalesce(count(distinct case when `eb`.`status` = 'Tersedia' then `eb`.`id_eksemplar_buku` end),0) AS `jumlah_buku_tersedia`, coalesce(count(distinct case when `eb`.`status` not in ('Hilang','Rusak') then `eb`.`id_eksemplar_buku` end),0) AS `jumlah_eksemplar` FROM (((`buku` `b` join `detail_buku` `db` on(`b`.`id_buku` = `db`.`id_buku`)) left join `ulasan_buku` `ub` on(`b`.`id_buku` = `ub`.`id_buku`)) join `eksemplar_buku` `eb` on(`b`.`id_buku` = `eb`.`id_buku`)) WHERE `eb`.`status` not in ('Hilang','Rusak') GROUP BY `b`.`id_buku`, `db`.`ISBN`, `db`.`tahun_terbit`, `db`.`penerbit`, `db`.`sinopsis`, `db`.`foto_buku`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_peminjaman_buku`
--
DROP TABLE IF EXISTS `view_peminjaman_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_peminjaman_buku`  AS SELECT `pb`.`id_peminjaman_buku` AS `id_peminjaman_buku`, `pb`.`id_eksemplar_buku` AS `id_eksemplar_buku`, `pb`.`id_user` AS `id_user`, `p`.`no_induk` AS `no_induk`, `pb`.`id_petugas` AS `id_petugas`, `u`.`nama` AS `nama_user`, `b`.`judul` AS `judul_buku`, `b`.`jenis_buku` AS `jenis_buku`, CASE WHEN `p`.`tahun_masuk` is null THEN 'Guru' WHEN year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` > 3 THEN 'Alumni' WHEN month(`pb`.`waktu_peminjaman`) < 7 THEN concat(case when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 1 then 'X-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 2 then 'XI-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 3 then 'XII-' end,`p`.`kelas`) WHEN month(`pb`.`waktu_peminjaman`) >= 7 THEN concat(case when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 0 then 'X-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 1 then 'XI-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 2 then 'XII-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 3 then 'Alumni' end,`p`.`kelas`) END AS `kelas`, `petugas`.`nama` AS `nama_petugas`, `pb`.`waktu_peminjaman` AS `waktu_peminjaman`, `pb`.`waktu_pengembalian` AS `waktu_pengembalian`, `pb`.`perpanjangan` AS `perpanjangan` FROM (((((`peminjaman_buku` `pb` join `users` `u` on(`pb`.`id_user` = `u`.`id_user`)) join `users` `petugas` on(`pb`.`id_petugas` = `petugas`.`id_user`)) join `eksemplar_buku` `eb` on(`pb`.`id_eksemplar_buku` = `eb`.`id_eksemplar_buku`)) join `buku` `b` on(`eb`.`id_buku` = `b`.`id_buku`)) join `pengunjung` `p` on(`p`.`id_user` = `pb`.`id_user`)) ORDER BY `pb`.`id_peminjaman_buku` DESC  ;

-- --------------------------------------------------------

--
-- Structure for view `view_pengunjung`
--
DROP TABLE IF EXISTS `view_pengunjung`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pengunjung`  AS SELECT `u`.`id_user` AS `id_user`, `u`.`username` AS `username`, `u`.`role` AS `role`, `u`.`nama` AS `nama_pengunjung`, `p`.`kelas` AS `kelas_asli`, `u`.`foto_profil` AS `foto_profil`, coalesce(`p`.`no_induk`,'-') AS `no_induk`, `p`.`tahun_masuk` AS `tahun_masuk`, coalesce(`p`.`alamat`,'-') AS `alamat`, CASE WHEN `p`.`tahun_masuk` = 'NULL' THEN '-' ELSE `get_kelas_siswa`(`p`.`tahun_masuk`,`p`.`kelas`) END AS `kelas` FROM (`users` `u` join `pengunjung` `p` on(`u`.`id_user` = `p`.`id_user`)) WHERE `u`.`role` = 'Pengunjung' OR `u`.`role` = 'Non Aktif''Non Aktif'  ;

-- --------------------------------------------------------

--
-- Structure for view `view_request_perpanjangan_buku`
--
DROP TABLE IF EXISTS `view_request_perpanjangan_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_request_perpanjangan_buku`  AS SELECT `r`.`id_request` AS `id_request`, `pb`.`id_peminjaman_buku` AS `id_peminjaman_buku`, `pb`.`id_eksemplar_buku` AS `id_eksemplar_buku`, `pb`.`id_user` AS `id_user`, `p`.`no_induk` AS `no_induk`, `pb`.`id_petugas` AS `id_petugas`, `pb`.`waktu_pengembalian` AS `waktu_pengembalian`, `u`.`nama` AS `nama_user`, `b`.`judul` AS `judul_buku`, `b`.`jenis_buku` AS `jenis_buku`, CASE WHEN `p`.`tahun_masuk` is null THEN 'Guru' WHEN year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` > 3 THEN 'Alumni' WHEN month(`pb`.`waktu_peminjaman`) < 7 THEN concat(case when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 1 then 'X-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 2 then 'XI-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 3 then 'XII-' end,`p`.`kelas`) WHEN month(`pb`.`waktu_peminjaman`) >= 7 THEN concat(case when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 0 then 'X-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 1 then 'XI-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 2 then 'XII-' when year(`pb`.`waktu_peminjaman`) - `p`.`tahun_masuk` = 3 then 'Alumni' end,`p`.`kelas`) END AS `kelas`, `r`.`waktu_request` AS `waktu_request`, `r`.`status` AS `status` FROM (((((`request_perpanjangan_buku` `r` join `peminjaman_buku` `pb` on(`r`.`id_peminjaman_buku` = `pb`.`id_peminjaman_buku`)) join `users` `u` on(`r`.`id_user` = `u`.`id_user`)) join `eksemplar_buku` `eb` on(`pb`.`id_eksemplar_buku` = `eb`.`id_eksemplar_buku`)) join `buku` `b` on(`eb`.`id_buku` = `b`.`id_buku`)) join `pengunjung` `p` on(`p`.`id_user` = `r`.`id_user`)) ORDER BY `r`.`id_request` DESC  ;

-- --------------------------------------------------------

--
-- Structure for view `view_ulasan_buku`
--
DROP TABLE IF EXISTS `view_ulasan_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ulasan_buku`  AS SELECT `pb`.`id_user` AS `id_user`, `u`.`nama` AS `nama_user`, `u`.`foto_profil` AS `foto_profil`, `ub`.`id_ulasan_buku` AS `id_ulasan_buku`, `ub`.`id_peminjaman` AS `id_peminjaman`, `ub`.`id_buku` AS `id_buku`, `b`.`judul` AS `judul`, `ub`.`rating` AS `rating`, `ub`.`komentar` AS `komentar`, `ub`.`waktu_ulasan` AS `waktu_ulasan` FROM (((`ulasan_buku` `ub` join `peminjaman_buku` `pb` on(`ub`.`id_peminjaman` = `pb`.`id_peminjaman_buku`)) join `users` `u` on(`pb`.`id_user` = `u`.`id_user`)) join `buku` `b` on(`b`.`id_buku` = `ub`.`id_buku`)) ORDER BY `ub`.`waktu_ulasan` DESC  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `denda_buku`
--
ALTER TABLE `denda_buku`
  ADD PRIMARY KEY (`id_denda_buku`),
  ADD KEY `id_peminjaman_buku` (`id_peminjaman_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_buku`
--
ALTER TABLE `detail_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `eksemplar_buku`
--
ALTER TABLE `eksemplar_buku`
  ADD PRIMARY KEY (`id_eksemplar_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `genre_buku`
--
ALTER TABLE `genre_buku`
  ADD PRIMARY KEY (`id_genre_buku`),
  ADD KEY `id_genre` (`id_genre`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD PRIMARY KEY (`id_peminjaman_buku`),
  ADD KEY `id_eksemplar_buku` (`id_eksemplar_buku`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `request_perpanjangan_buku`
--
ALTER TABLE `request_perpanjangan_buku`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_peminjaman_buku` (`id_peminjaman_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id_ulasan_buku`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `denda_buku`
--
ALTER TABLE `denda_buku`
  MODIFY `id_denda_buku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eksemplar_buku`
--
ALTER TABLE `eksemplar_buku`
  MODIFY `id_eksemplar_buku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre_buku`
--
ALTER TABLE `genre_buku`
  MODIFY `id_genre_buku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  MODIFY `id_peminjaman_buku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_perpanjangan_buku`
--
ALTER TABLE `request_perpanjangan_buku`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id_ulasan_buku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `denda_buku`
--
ALTER TABLE `denda_buku`
  ADD CONSTRAINT `denda_buku_ibfk_1` FOREIGN KEY (`id_peminjaman_buku`) REFERENCES `peminjaman_buku` (`id_peminjaman_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `denda_buku_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_buku`
--
ALTER TABLE `detail_buku`
  ADD CONSTRAINT `detail_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksemplar_buku`
--
ALTER TABLE `eksemplar_buku`
  ADD CONSTRAINT `eksemplar_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON UPDATE CASCADE;

--
-- Constraints for table `genre_buku`
--
ALTER TABLE `genre_buku`
  ADD CONSTRAINT `genre_buku_ibfk_1` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_buku_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD CONSTRAINT `peminjaman_buku_ibfk_1` FOREIGN KEY (`id_eksemplar_buku`) REFERENCES `eksemplar_buku` (`id_eksemplar_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_buku_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_buku_ibfk_3` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `pengunjung_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_perpanjangan_buku`
--
ALTER TABLE `request_perpanjangan_buku`
  ADD CONSTRAINT `request_perpanjangan_buku_ibfk_1` FOREIGN KEY (`id_peminjaman_buku`) REFERENCES `peminjaman_buku` (`id_peminjaman_buku`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_perpanjangan_buku_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD CONSTRAINT `ulasan_buku_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman_buku` (`id_peminjaman_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_buku_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `notifikasi_peminjaman` ON SCHEDULE EVERY 1 DAY STARTS '2024-12-20 10:56:07' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_notifikasi (
        id_peminjaman_buku INT,
        id_user INT,
        judul_buku VARCHAR(50),
        jenis_buku VARCHAR(50),
        hari_terlambat INT,
        pesan VARCHAR(255)
    );

    DELETE FROM temp_notifikasi
    WHERE id_peminjaman_buku IN (
        SELECT p.id_peminjaman_buku
        FROM peminjaman_buku p
        JOIN eksemplar_buku e ON p.id_eksemplar_buku = e.id_eksemplar_buku
        WHERE p.waktu_pengembalian IS NOT NULL
    );

    INSERT INTO temp_notifikasi (id_peminjaman_buku, id_user, judul_buku, jenis_buku, hari_terlambat, pesan)
    SELECT p.id_peminjaman_buku, p.id_user, b.judul, b.jenis_buku,
           DATEDIFF(CURDATE(), p.waktu_peminjaman) - 
           (CASE 
                WHEN b.jenis_buku = 'NON Paket Pelajaran' AND p.perpanjangan = FALSE THEN 6
                WHEN b.jenis_buku = 'NON Paket Pelajaran' AND p.perpanjangan = TRUE THEN 9
                ELSE 0 
            END) AS hari_terlambat,
           CASE
               WHEN DATEDIFF(CURDATE(), p.waktu_peminjaman) <= 1 THEN 'Masa peminjaman tinggal satu hari lagi'
               WHEN DATEDIFF(CURDATE(), p.waktu_peminjaman) > (CASE 
               WHEN b.jenis_buku = 'NON Paket Pelajaran' AND p.perpanjangan = FALSE THEN 6
               WHEN b.jenis_buku = 'NON Paket Pelajaran' AND p.perpanjangan = TRUE THEN 9
            	ELSE 0 
            END) THEN 
                   CONCAT(DATEDIFF(CURDATE(), p.waktu_peminjaman) - 
           (CASE 
               WHEN b.jenis_buku = 'NON Paket Pelajaran' AND p.perpanjangan = FALSE THEN 6
               WHEN b.jenis_buku = 'NON Paket Pelajaran' AND p.perpanjangan = TRUE THEN 9
               	ELSE 0 
           END), ' hari telat')
           	ELSE 'Masa peminjaman masih berlaku'
           END AS pesan
    FROM peminjaman_buku p
    JOIN buku b ON p.id_eksemplar_buku = b.id_buku
    JOIN eksemplar_buku e ON p.id_eksemplar_buku = e.id_eksemplar_buku
    WHERE p.waktu_pengembalian IS NULL;
    
    SELECT * FROM temp_notifikasi;

END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
