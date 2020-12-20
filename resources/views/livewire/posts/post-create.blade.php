<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog"
     aria-labelledby="createPost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Post</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <label for="title">Post Title:</label>
                        <input wire:model.defer="title" type="text" class="form-control" name="title"
                               title="Post title" placeholder="Enter post title..." autofocus>
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Post Content:</label>
                        <textarea wire:model.defer="body" name="body" rows="5" class="form-control"
                                  title="Post content" placeholder="Enter post content..."></textarea>
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
                        @if ($uploadedThumbnail)
                            <br>
                            Thumb Preview:
                            <img src="{{ $uploadedThumbnail->temporaryUrl() }}" alt="temp thumbnail"
                                 width="50px" height="50px">
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button wire:click.prevent="store" type="submit" class="btn btn-primary" data-dismiss="modal">Submit
                </button>
            </div>
        </div>
    </div>
</div>