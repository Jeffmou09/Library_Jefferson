<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Library System</div>
        <div class="menu">
            <a href="/">Books</a>
            <a href="/members" class="active">Members</a>
            <a href="/borrowings">Borrowings</a>
        </div>
    </div>

    <!-- Form Tambah Member -->
    <div class="add-member-container">
    <h1>Edit Member</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST" class="post">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $member->name }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $member->email }}" required>
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ $member->phone }}" required>
        </div>

        <button type="submit">Update Member</button>
    </form>
    </div>
</body>
</html>
