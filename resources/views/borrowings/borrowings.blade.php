<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowings</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
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

    <!-- Content -->
    <div style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Borrowings</h1>
        <a href="{{ route('borrowings.create') }}" class="btn-add-book">Add</a>
    </div>

    @if(session('success'))
    <div class="{{ session('success') == 'Borrowing deleted successfully!' ? 'delete-message' : 'success-message' }}">
        {{ session('success') }}
    </div>
    @endif

    <table class="member-table">
    <thead>
        <tr>
            <th class="table-header">Book Name</th>
            <th class="table-header">Member Name</th>
            <th class="table-header">Borrow Date</th>
            <th class="table-header">Due Date</th>
            <th class="table-header">Status</th>
            <th class="table-header">Return Date</th>
            <th class="table-header">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($borrowings as $borrowing)
        <tr class="table-row">
            <td class="table-data">{{ $borrowing->book->title }}</td>
            <td class="table-data">{{ $borrowing->member->name }}</td> 
            <td class="table-data">{{ $borrowing->borrow_date }}</td> 
            <td class="table-data">{{ $borrowing->due_date }}</td> 
            <td class="table-data">{{ $borrowing->status }}</td>
            <td class="table-data">{{ $borrowing->return_date ?? 'Not Returned' }}</td> 
            <td class="table-actions">
                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')    
                    <button type="submit" class="btn-return">Return</button>
                </form>
                <a href="{{ route('borrowings.edit', $borrowing->id) }}" class="btn-edit">Edit</a>
                <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" style="display: inline;">
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