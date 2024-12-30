<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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

    <!-- Form Edit Buku -->
    <div class="edit-book" style="padding: 20px;">
        <h1>Edit Book</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST" class="post">
            @csrf
            @method('PUT') <!-- Menandakan bahwa kita melakukan update, bukan create -->

            <div>
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <br>
            
            <div>
                <label for="author">Author:</label><br>
                <input type="text" id="author" name="author" value="{{ $book->author }}" required>
            </div>
            <br>
            
            <div>
                <label for="year_published">Year Published:</label><br>
                <input type="number" id="year_published" name="year_published" value="{{ $book->year_published }}" required>
            </div>
            <br>
            
            <button type="submit">Update Book</button>
        </form>
    </div>

</body>
</html>
