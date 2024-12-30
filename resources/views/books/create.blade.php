<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Library System</div>
        <div class="menu">
            <a href="/" class="active">Books</a>
            <a href="/members">Members</a>
            <a href="/borrowings">Borrowings</a>
        </div>
    </div>

    <!-- Form Tambah Buku -->
<div class="add-book-container">
    <h1>Add a New Book</h1>

    <form action="{{ route('books.store') }}" method="POST" class="post">
        @csrf <!-- CSRF token untuk keamanan -->
        
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        
        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
        </div>
        
        <div>
            <label for="year_published">Year Published:</label>
            <input type="number" id="year_published" name="year_published" required>
        </div>
        
        <button type="submit">Add Book</button>
    </form>
</div>
</body>
</html>
