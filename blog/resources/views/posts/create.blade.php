<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="mb-3">
        <label for="publication_year" class="form-label">Publication Year</label>
        <input type="number" class="form-control" id="publication_year" name="publication_year" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>
