<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrowing</title>
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
    <h1>Edit Borrowing</h1>

    <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST" class="post">
        @csrf 
        @method('PUT')
        
        <!-- Dropdown untuk Nama Peminjam -->
        <label for="member_id">Nama Peminjam:</label>
        <select name="member_id" id="member_id" required>
            <option value="" disabled selected>Pilih Nama Peminjam</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}" 
                        @if (old('member_id', $borrowing->member->id) == $member->id) selected @endif>
                    {{ $member->name }}
                </option>
            @endforeach
        </select>

        <!-- Dropdown untuk Nama Buku -->
        <label for="book_id">Nama Buku:</label>
        <select name="book_id" id="book_id" required>
            <option value="" disabled selected>Pilih Nama Buku</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}" 
                        @if(old('book_id', $borrowing->book->id) == $book->id) selected @endif>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>

        <!-- Input untuk Tanggal Peminjaman -->
        <label for="borrow_date">Tanggal Peminjaman:</label>
        <input type="date" name="borrow_date" id="borrow_date" value="{{ date('Y-m-d') }}" style="margin-bottom: 10px;" required>

        <label for="status">Status:</label>
        <select name="status" id="status" style="margin-bottom: 10px;" required>
            <option value="" disabled selected>Pilih Status</option>
            <option value="Borrowed" @if(old('status', $borrowing->status) == 'Borrowed') selected @endif>Borrowed</option>
            <option value="Returned" @if(old('status', $borrowing->status) == 'Returned') selected @endif>Returned</option>
        </select>
        
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
