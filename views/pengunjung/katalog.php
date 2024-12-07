<?php

require './include/Pengunjung_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
    header("Location: ./error-403.php");
}

$res = getDataBooks();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SMAN 2 Binjai</title>
    <?php include "./include/css.php"; ?>
    <link rel="stylesheet" href="../../assets/css/catalog.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container-scroller">
        <?php include "./include/navbar.php"; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include "../../include/sidebar_setting.php"; ?>
            <?php include "./include/sidebar.php"; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Search Bar -->
                    <div class="row mb-4">
                        <div class="col text-end">
                            <input type="text" id="searchInput" class="form-control d-inline-block w-auto"
                                placeholder="Cari Buku Disini.." onkeyup="filterBooks()">
                        </div>
                    </div>

                    <!-- Book List -->
                    <div class="row catalog-book-list" id="bookList">
                        <!-- Buku akan dirender secara dinamis -->
                    </div>


                    <!-- Pagination -->
                    <div class="row mt-4">
                        <div class="col text-center">
                            <button class="btn btn-outline-primary mx-1" id="prevPage" onclick="changePage(-1)"
                                disabled>&lt; Prev</button>
                            <span id="paginationInfo" class="mx-3"></span>
                            <button class="btn btn-outline-primary mx-1" id="nextPage" onclick="changePage(1)"
                                disabled>&gt; Next</button>
                        </div>
                    </div>

                </div>
                <?php
                include "../../include/footer.php";
                ?>
            </div>
        </div>
    </div>

    <?php



    $books = [];
    // Menggunakan foreach untuk memproses data dan memasukkannya ke dalam $res
    foreach ($res as $data) {
        // Mengisi array $books dengan data yang sudah diproses (menggunakan htmlspecialchars untuk keamanan)
        $books[] = [
            'id_buku' => $data['id_buku'],
            'judul' => htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'),
            'penulis' => htmlspecialchars($data['penulis'], ENT_QUOTES, 'UTF-8'),
            'foto_buku' => htmlspecialchars($data['foto_buku'], ENT_QUOTES, 'UTF-8'),
            'rating' => $data['rating'],
            'jumlah_pemberi_rating' => $data['jumlah_pemberi_rating'],
            'sinopsis' => htmlspecialchars($data['sinopsis'], ENT_QUOTES, 'UTF-8')
        ];
    }

    ?>

    <script>
        // Data asli buku
        const allBooks = <?php echo json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>;
        //menggunakan $res langsung pun bisa, tapi karena menghindari specialchar, jadi dipindah kan ke books dulu

        // Data buku yang difilter
        let filteredBooks = [...allBooks];

        // Pagination settings
        const booksPerPage = 10;
        let currentPage = 1;

        // Fungsi untuk merender buku berdasarkan halaman saat ini
        function renderBooks() {
            const bookList = document.getElementById("bookList");
            bookList.innerHTML = "";

            // Hitung indeks buku yang akan ditampilkan
            const startIndex = (currentPage - 1) * booksPerPage;
            const endIndex = startIndex + booksPerPage;
            const booksToShow = filteredBooks.slice(startIndex, endIndex);

            // Jika tidak ada buku yang ditemukan
            if (booksToShow.length === 0) {
                bookList.innerHTML = `
                    <div class="col-12 text-center">
                        <div class="alert alert-warning" role="alert">
                            <strong>Maaf, buku yang Anda cari tidak tersedia.</strong><br>
                            Coba gunakan kata kunci yang lain.
                        </div>
                    </div>
                `;
            } else {
                // Render buku pada halaman ini
                booksToShow.forEach(book => {
                    const bookItem = document.createElement("div");
                    bookItem.className = "col-md-6 mb-4 catalog-book-item";
                    bookItem.innerHTML = `
                <div class="catalog-card d-flex">
                    <img src="${book.foto_buku}" class="catalog-card-img" alt="${book.judul}">
                    <div class="catalog-card-body">
                        <h5 class="catalog-card-title">${book.judul}</h5>
                        <p class="catalog-card-author">by ${book.penulis}</p>
                        <div class="catalog-card-rating">Rating: ${book.rating}</div>
                        <div class="catalog-card-voter">${book.jumlah_pemberi_rating} voters</div>
                        <p class="catalog-card-text">${book.sinopsis}</p>
                        <div class="book-see book-blue">
                            <a class="text-light" href="./detail_katalog.php?id=${book.id_buku}">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            `;
                    bookList.appendChild(bookItem);
                });
            }

            updatePaginationInfo();
        }


        // Fungsi untuk memperbarui informasi pagination dan tombol navigasi
        function updatePaginationInfo() {
            const totalPages = Math.ceil(filteredBooks.length / booksPerPage);

            document.getElementById("paginationInfo").textContent = `Page ${currentPage} of ${totalPages}`;

            // Perbarui status tombol prev/next
            document.getElementById("prevPage").disabled = currentPage === 1;
            document.getElementById("nextPage").disabled = currentPage === totalPages;
        }

        // Fungsi untuk berpindah halaman
        function changePage(direction) {
            const totalPages = Math.ceil(filteredBooks.length / booksPerPage);
            currentPage = Math.min(Math.max(currentPage + direction, 1), totalPages);

            renderBooks();
        }

        // Fungsi pencarian buku
        function filterBooks() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();

            // Jika pencarian kosong, kembalikan filteredBooks ke allBooks
            if (searchInput === "") {
                filteredBooks = [...allBooks]; // Kembalikan ke data awal jika kosong
            } else {
                // Filter buku berdasarkan input pencarian
                filteredBooks = allBooks.filter(book =>
                    book.judul.toLowerCase().includes(searchInput) ||
                    book.penulis.toLowerCase().includes(searchInput)
                );

            }

            // Reset ke halaman pertama setiap kali pencarian dilakukan
            currentPage = 1;
            renderBooks();
        }


        // Event listener untuk pencarian
        document.getElementById("searchInput").addEventListener("keyup", filterBooks);

        // Render buku pertama kali saat halaman dimuat
        renderBooks();


    </script>

    <?php include "./include/js.php"; ?>
</body>

</html>