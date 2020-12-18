<div class="h-100">

    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="mx-auto my-auto" style="width: 200px;height: 100%">
        <img wire:loading.delay src="{{asset('images/spinner.svg')}}" alt="Loading..." class="position-absolute">
    </div>


    <!-- Edit Modal -->
    @include('livewire.posts.post-edit')
    <!-- Edit Category Bulk Modal -->
    @include('livewire.posts.post-edit-bulk')
    <!-- Create Modal -->
    @include('livewire.posts.post-create')
    <!-- Delete Confirmation Modal -->
    @include('livewire.posts.post-delete')
    <!-- View Modal -->
    @include('livewire.posts.post-view')


    <button data-bs-toggle="modal" data-bs-target="#createModal"
            class="btn btn-success btn-md mb-2">Create New Post</button>

    <button data-bs-toggle="modal" data-bs-target="#deleteModal"
            class="btn btn-danger btn-md mb-2" {{ $bulkDisabled ? 'disabled' : null }}>Bulk Delete
    </button>

    <button wire:click.prevent="initDataBulk" data-bs-toggle="modal"
            data-bs-target="#editBulkModal"
            class="btn btn-primary btn-md mb-2" {{ $bulkDisabled ? 'disabled' : null }}>Bulk Edit
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
            @forelse($paginatedPosts as $post)
                <tr>
                    <td>
                        <input wire:model="selectedPosts" value="{{$post->id}}" type="checkbox">
                    </td>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#viewModal"
                                wire:click="initData({{ $post }})"
                                class="btn btn-info btn-sm">View
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#editModal"
                                wire:click="initData({{ $post }})"
                                class="btn btn-primary btn-sm">Edit
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal"
                                wire:click="initData({{ $post }})"
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
        {{$paginatedPosts->links()}}
    </div>
</div>