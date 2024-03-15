<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" value="{{ $post->author }}">
    </div>
    <div class="mb-3">
        <label for="publication_year" class="form-label">Publication Year</label>
        <input type="number" class="form-control" id="publication_year" name="publication_year" value="{{ $post->publication_year }}">
    </div>
    <button type="submit" class="btn btn-primary">Update Post</button>
</form>


<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <p>Are you sure you want to delete this post?</p>
    <button type="submit" class="btn btn-danger">Delete Post</button>
</form>
