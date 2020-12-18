<div wire:ignore.self class="modal fade" id="viewModal" tabindex="-1" role="dialog"
     aria-labelledby="viewPost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Post Details</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h6 class="text-decoration-underline">Title</h6>
                <p class="text-muted">{{$title}}</p>
                <hr>
                <h6 class="text-decoration-underline">Content</h6>
                <p class="text-muted">{{$body}}</p>
                <hr>
                <h6 class="text-decoration-underline">Category</h6>
                <p class="text-muted">{{$categoryName}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>