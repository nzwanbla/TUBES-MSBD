function searchBooks() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const bookItems = document.querySelectorAll('.book-item');

bookItems.forEach(item => {
    const title = item.querySelector('h3').textContent.toLowerCase();
    const dataTitle = item.getAttribute('data-title').toLowerCase();

    if (title.includes(input) || dataTitle.includes(input)) {
        item.style.display = 'flex';
    } else {
        item.style.display = 'none';
    }
});
}

function goToDetail(button) {
    const bookItem = button.closest('.book-item');
    const bookId = bookItem.getAttribute('data-id'); 
    window.location.href = `detail.php?id=${bookId}`;
}

document.getElementById('searchInput').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') { 
        searchBooks();
    }
});
