<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
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

    <script>
        // Data asli buku
        const allBooks = [
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            { title: "Biologi", author: "John Doe", description: "A deep dive into the study of life and living organisms.", img: "../../assets/images/perpus.png", rating: 4, voters: 120, sinopsis: "This book explores the basics of biology, from cellular biology to ecosystem dynamics." },
            { title: "Aritmetika", author: "Jane Smith", description: "An introduction to basic arithmetic operations.", img: "../../assets/images/default_profile.jpg", rating: 3, voters: 90, sinopsis: "This book provides a comprehensive approach to arithmetic, explaining operations such as addition, subtraction, multiplication, and division." },
            { title: "Fisika", author: "Albert Einstein", description: "A deep dive into the world of physics and its phenomena.", img: "https://via.placeholder.com/120x180", rating: 5, voters: 200, sinopsis: "This book focuses on fundamental concepts of physics, including mechanics, thermodynamics, and electromagnetism." },
            // Tambahkan buku lainnya di sini...
        ];

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

            // Render buku pada halaman ini
            booksToShow.forEach(book => {
                const bookItem = document.createElement("div");
                bookItem.className = "col-md-6 mb-4 catalog-book-item";
                bookItem.innerHTML = `
            <div class="catalog-card d-flex">
                <img src="${book.img}" class="catalog-card-img" alt="${book.title}">
                <div class="catalog-card-body">
                    <h5 class="catalog-card-title">${book.title}</h5>
                    <p class="catalog-card-author">by ${book.author}</p>
                    <div class="catalog-card-rating">Rating: ${book.rating}/5</div>
                    <div class="catalog-card-voter">${book.voters} voters</div>
                    <p class="catalog-card-text">${book.sinopsis}</p>
                    <button class="btn btn-primary catalog-btn">View Detail</button>
                </div>
            </div>
        `;
                bookList.appendChild(bookItem);
            });

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
                    book.title.toLowerCase().includes(searchInput)
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