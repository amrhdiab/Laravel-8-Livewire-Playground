<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="form-group">
                        <label for="title">Post Title:</label>
                        <input wire:model.defer="title" type="text" class="form-control" name="title"
                               title="Post title" placeholder="Post title..." autofocus>
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Post Content:</label>
                        <textarea wire:model.defer="body" name="body" rows="5" class="form-control"
                                  title="Post content"></textarea>
                        @error('body')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select wire:model.defer="category_id" name="category" id="category" class="form-control"
                                title="Category">
                            <option value="">Select Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail:</label>
                        <input wire:model="uploadedThumbnail" type="file" name="thumbnail" id="thumbnail" class="form-control">
                        @error('thumbnail')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <br>
                        Thumb Preview:
                        @if ($uploadedThumbnail)
                            <img src="{{ $uploadedThumbnail->temporaryUrl() }}" alt="temp thumbnail"
                                 width="50px" height="50px">
                        @elseif($thumbnail)
                            <img src="{{asset('storage/posts/thumb_uploads').'/'.$thumbnail}}" alt="post thumbnail"
                                 width="50px" height="50px">
                        @endif
                    </div>
                    <input wire:model="post_id" type="hidden" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" wire:click.prevent="update"
                        class="btn btn-primary" data-dismiss="modal">Update
                </button>
            </div>
        </div>
    </div>
</div>