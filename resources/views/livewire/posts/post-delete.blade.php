<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
     aria-labelledby="createPost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Post/s Deletion</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete selected post/s?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="delete"
                        class="btn btn-danger" data-dismiss="modal">Delete
                </button>
            </div>
        </div>
    </div>
</div>