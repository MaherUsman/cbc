<div class="d-flex justify-content-center">
    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-primary me-1">Edit</a>
    <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</div>

