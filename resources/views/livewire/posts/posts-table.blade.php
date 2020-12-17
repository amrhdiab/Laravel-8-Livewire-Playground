<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <!-- Edit Modal -->
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
                    @livewire('posts.post-edit')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" wire:click.prevent="$emitTo('posts.post-edit','update')"
                            class="btn btn-primary" data-dismiss="modal">Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
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
                    @livewire('posts.post-create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" wire:click.prevent="$emitTo('posts.post-create','store')"
                            class="btn btn-primary" data-dismiss="modal">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
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
                    @livewire('posts.post-delete')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="$emitTo('posts.post-delete','delete')"
                            class="btn btn-danger" data-dismiss="modal">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog"
         aria-labelledby="viewPost" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Post Details</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @livewire('posts.post-view')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <button data-bs-toggle="modal" data-bs-target="#createModal"
            class="btn btn-success btn-md mb-2">Create New Post
    </button>
    <button wire:click.prevent="$emitTo('posts.post-delete','initBulkDelete',{{json_encode($selected)}})" data-bs-toggle="modal" data-bs-target="#deleteModal"
            class="btn btn-danger btn-md mb-2">Bulk Delete
    </button>
    <div class="row">
        <div class="col-md-3">
            <label for="search">Search: </label>
            <input wire:model="query" id="search" type="text" placeholder="Search...">
            <p class="badge badge-info" wire:model="resultCount">{{$resultCount}}</p>
        </div>
        <div class="col-md-3">
            <label for="orderBy">Order By: </label>
            <select wire:model="orderBy" id="orderBy">
                <option value="id">Id</option>
                <option value="title">Title</option>
                <option value="category_id">Category</option>
                <option value="created_at">Publish Date</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="direction">Order direction: </label>
            <select wire:model="orderAsc" id="direction">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="perPage">Items Per Page: </label>
            <select wire:model="perPage" id="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>title</th>
                <th>category</th>
                <th>Publish Date</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        <input wire:model="selected" type="checkbox" value="{{$post->id}}">
                    </td>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#viewModal"
                                wire:click="$emitTo('posts.post-view','initView',{{ $post }})"
                                class="btn btn-info btn-sm">View
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#editModal"
                                wire:click="$emitTo('posts.post-edit','initEdit',{{ $post }})"
                                class="btn btn-primary btn-sm">Edit
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal"
                                wire:click="$emitTo('posts.post-delete','initDelete',{{ $post }})"
                                class="btn btn-danger btn-sm">Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No posts found...</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$posts->links()}}
    </div>
</div>