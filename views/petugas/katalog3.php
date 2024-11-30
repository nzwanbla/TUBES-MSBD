<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="../../assets/css/katalog.css">
</head>

<body>
    <div class="header">
        <h1>katalog Buku</h1>
    </div>

    <div class="container">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari Buku Disini..">
            <button onclick="searchBooks()">Search</i></button>
        </div>
            <div class="book-list" id="bookList">
            <div class="book-item" data-title="Biologi">
                <img src="https://storage.googleapis.com/a1aa/image/CM3zfykxD0zEMqatm0WX2GsGOGkn9SkyH2klCvqQ3lWLoV6JA.jpg" alt="Book cover of 'The Snowball: Warren Buffett and the Business of Life' by Warren Buffett">
                <div class="book-content">
                    <h3>Biologi</h3>
                    <p>Born in Nebraska in 1930, Warren Buffett demonstrated keen business abilities at a young age. He formed Buffett Partnership.</p>
                    <div class="read-more">
                        <button onclick="goToDetail(this)"> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="Aritmetika">
                <img src="https://storage.googleapis.com/a1aa/image/eRIffbAEeptyIT4wZablm2qBKJAkUI19muV9aZ6vUImjBtSPB.jpg" alt="Book cover of 'Gandhi: True Experiment' by Gandhi">
                <div class="book-content">
                    <h3>Aritmetika</h3>
                    <p>Born and raised in a Hindu merchant caste family in coastal Gujarat, India, and trained in law at the Inner Temple, London, Gandhi first.</p>
                    <div class="read-more">
                    <button onclick="goToDetail(this)"> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="True experiment">
                <img src="https://storage.googleapis.com/a1aa/image/eRIffbAEeptyIT4wZablm2qBKJAkUI19muV9aZ6vUImjBtSPB.jpg" alt="Book cover of 'Gandhi: True Experiment' by Gandhi">
                <div class="book-content">
                    <h3>True experiment</h3>
                    <p>Born and raised in a Hindu merchant caste family in coastal Gujarat, India, and trained in law at the Inner Temple, London, Gandhi first.</p>
                    <div class="read-more">
                        <button> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="True experiment">
                <img src="https://storage.googleapis.com/a1aa/image/eRIffbAEeptyIT4wZablm2qBKJAkUI19muV9aZ6vUImjBtSPB.jpg" alt="Book cover of 'Gandhi: True Experiment' by Gandhi">
                <div class="book-content">
                    <h3>True experiment</h3>
                    <p>Born and raised in a Hindu merchant caste family in coastal Gujarat, India, and trained in law at the Inner Temple, London, Gandhi first.</p>
                    <div class="read-more">
                        <button> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="Warren Buffett">
                <img src="https://storage.googleapis.com/a1aa/image/CM3zfykxD0zEMqatm0WX2GsGOGkn9SkyH2klCvqQ3lWLoV6JA.jpg" alt="Book cover of 'The Snowball: Warren Buffett and the Business of Life' by Warren Buffett">
                <div class="book-content">
                    <h3>Warren Buffett</h3>
                    <p>Born in Nebraska in 1930, Warren Buffett demonstrated keen business abilities at a young age. He formed Buffett Partnership.</p>
                    <div class="read-more">
                        <button> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="Warren Buffett">
                <img src="https://storage.googleapis.com/a1aa/image/CM3zfykxD0zEMqatm0WX2GsGOGkn9SkyH2klCvqQ3lWLoV6JA.jpg" alt="Book cover of 'The Snowball: Warren Buffett and the Business of Life' by Warren Buffett">
                <div class="book-content">
                    <h3>Warren Buffett</h3>
                    <p>Born in Nebraska in 1930, Warren Buffett demonstrated keen business abilities at a young age. He formed Buffett Partnership.</p>
                    <div class="read-more">
                        <button> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="Warren Buffett">
                <img src="https://storage.googleapis.com/a1aa/image/CM3zfykxD0zEMqatm0WX2GsGOGkn9SkyH2klCvqQ3lWLoV6JA.jpg" alt="Book cover of 'The Snowball: Warren Buffett and the Business of Life' by Warren Buffett">
                <div class="book-content">
                    <h3>Warren Buffett</h3>
                    <p>Born in Nebraska in 1930, Warren Buffett demonstrated keen business abilities at a young age. He formed Buffett Partnership.</p>
                    <div class="read-more">
                        <button> View Detail </button>
                    </div>
                </div>
            </div>
            <div class="book-item" data-title="True experiment">
                <img src="https://storage.googleapis.com/a1aa/image/eRIffbAEeptyIT4wZablm2qBKJAkUI19muV9aZ6vUImjBtSPB.jpg" alt="Book cover of 'Gandhi: True Experiment' by Gandhi">
                <div class="book-content">
                    <h3>True experiment</h3>
                    <p>Born and raised in a Hindu merchant caste family in coastal Gujarat, India, and trained in law at the Inner Temple, London, Gandhi first.</p>
                    <div class="read-more">
                        <button> View Detail </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-container">
            <div class="pagination-new">
                <a href="#" class="disabled">&lt;</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">7</a>
                <a href="#">&gt;</a>
            </div>
        </div>
    </div>

<?php include "./include/js.php"; ?>
</body>
</html>
