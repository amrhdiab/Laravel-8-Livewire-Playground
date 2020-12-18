<div wire:ignore.self class="modal fade" id="editBulkModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateBulk">
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select wire:model.defer="selectedCategory" name="category" id="category" class="form-control"
                                title="Category">
                            <option value="">Select Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('selectedCategory')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" wire:click.prevent="updateBulk"
                        class="btn btn-primary" data-dismiss="modal">Update
                </button>
            </div>
        </div>
    </div>
</div>