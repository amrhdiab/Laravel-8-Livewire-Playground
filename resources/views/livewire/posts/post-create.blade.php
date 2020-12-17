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
        <select name="category" id="category" class="form-control" title="Category">
            <option value="">Select Category...</option>
        </select>
        @error('body')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</form>