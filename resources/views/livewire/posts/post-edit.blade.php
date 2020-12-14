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
    <input wire:model="post_id" type="hidden" name="id">
</form>