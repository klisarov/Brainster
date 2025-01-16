function Book(title, author, maxPages, onPage) {
    this.title = title;
    this.author = author;
    this.maxPages = maxPages;
    this.onPage = onPage;
}

var books = [
    new Book("The Hobbit", "J.R.R. Tolkien", 310, 310),
    new Book("The Lord of the Rings", "J.R.R. Tolkien", 1178, 250),
    new Book("Harry Potter and the Sorcerer's Stone", "J.K. Rowling", 309, 150)
];

function updateBookList() {
    var bookList = document.getElementById('bookList');
    bookList.innerHTML = '';

    for (var i = 0; i < books.length; i++) {
        var book = books[i];
        var li = document.createElement('li');
        if (book.maxPages === book.onPage) {
            li.className = 'read';
            li.textContent = 'You already read "' + book.title + '" by ' + book.author + '.';
        } else {
            li.className = 'not-read';
            li.textContent = 'You still need to read "' + book.title + '" by ' + book.author + '.';
        }
        bookList.appendChild(li);
    }
}

function updateBookTable() {
    var bookTableBody = document.getElementById('bookTableBody');
    bookTableBody.innerHTML = '';

    for (var i = 0; i < books.length; i++) {
        var book = books[i];
        var row = bookTableBody.insertRow();
        row.insertCell(0).textContent = book.title;
        row.insertCell(1).textContent = book.author;

        var progressCell = row.insertCell(2);
        var progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        var progress = document.createElement('div');
        progress.className = 'progress';
        var percentage = Math.round((book.onPage / book.maxPages) * 100);
        progress.style.width = percentage + '%';
        progress.textContent = percentage + '%';
        progressBar.appendChild(progress);
        progressCell.appendChild(progressBar);
    }
}

document.getElementById('addBookForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var title = document.getElementById('title').value;
    var author = document.getElementById('author').value;
    var maxPages = parseInt(document.getElementById('maxPages').value);
    var onPage = parseInt(document.getElementById('onPage').value);

    var newBook = new Book(title, author, maxPages, onPage);
    books.push(newBook);

    updateBookList();
    updateBookTable();

    this.reset();
});

