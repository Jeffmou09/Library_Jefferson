<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Borrowing</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Library System</div>
        <div class="menu">
            <a href="/">Books</a>
            <a href="/members">Members</a>
            <a href="/borrowings" class="active">Borrowings</a>
        </div>
    </div>

    <!-- Form Tambah Buku -->
<div class="add-book-container">
    <h1>Add Borrowing</h1>

    <form action="{{ route('borrowings.store') }}" method="POST" class="post">
        @csrf <!-- CSRF token untuk keamanan -->
        
        <!-- Dropdown untuk Nama Peminjam -->
        <label for="member_id">Nama Peminjam:</label>
        <select name="member_id" id="member_id" style="margin-bottom: 10px;" required>
            <option value="" disabled selected>Pilih Nama Peminjam</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
        </select>

        <!-- Dropdown untuk Nama Buku -->
        <label for="book_id">Nama Buku:</label>
        <select name="book_id" id="book_id" style="margin-bottom: 10px;" required>
            <option value="" disabled selected>Pilih Nama Buku</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
        @error('book_id')
            <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
        @enderror

        <!-- Input untuk Tanggal Peminjaman -->
        <label for="borrow_date">Tanggal Peminjaman:</label>
        <input type="date" name="borrow_date" id="borrow_date" value="{{ date('Y-m-d') }}" style="margin-bottom: 10px;" required>
        
        <button type="submit">Add</button>
    </form>
</div>
</body>
</html>
