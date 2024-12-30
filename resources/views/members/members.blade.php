<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
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

    <!-- Content -->
    <div style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Members</h1>
        <a href="{{ route('members.create') }}" class="btn-add-book">Add Member</a>
    </div>

    @if(session('success'))
    <div class="{{ session('success') == 'Member deleted successfully!' ? 'delete-message' : 'success-message' }}">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tabel daftar member -->
    <table class="member-table">
    <thead>
        <tr>
            <th class="table-header">Name</th>
            <th class="table-header">Email</th>
            <th class="table-header">Phone</th>
            <th class="table-header">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr class="table-row">
                <td class="table-data">{{ $member->name }}</td>
                <td class="table-data">{{ $member->email }}</td>
                <td class="table-data">{{ $member->phone }}</td>
                <td class="table-actions">
                    <a href="{{ route('members.edit', $member->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>