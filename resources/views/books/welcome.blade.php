<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
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

    <!-- Content -->
    <div style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Books Catalog</h1>
        <a href="{{ route('books.create') }}" class="btn-add-book">Add Book</a>
    </div>

    @if(session('success'))
    <div class="{{ session('success') == 'Book deleted successfully!' ? 'delete-message' : 'success-message' }}">
        {{ session('success') }}
    </div>
    @endif

    <!-- Katalog Buku -->
    <div class="book-catalog">
        @foreach ($books as $book)
        <div class="book-item" style="padding: 20px; margin-bottom: 20px; position: relative;">
            <!-- Tombol Edit di kiri atas -->
            <a href="{{ route('books.edit', $book->id) }}" class="edit-button">Edit</a>
        
            <!-- Tombol Delete di kanan atas -->
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Delete</button>
            </form>

            <h3>{{ $book->title }}</h3>
            <p>Author: {{ $book->author }}</p>
            <p>Year Published: {{ $book->year_published }}</p>
        </div>
        @endforeach

        @if ($books->isEmpty())
            <p>No books found in the library.</p>
        @endif
    </div>
</body>
</html>