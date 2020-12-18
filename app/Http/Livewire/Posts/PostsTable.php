<?php /** @noinspection ALL */

/** @noinspection PhpUndefinedVariableInspection */

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class PostsTable extends Component
{
	use WithPagination, AuthorizesRequests;

	//DataTable props
	public ?string $query = null;
	public ?string $resultCount;
	public string $orderBy = 'created_at';
	public string $orderAsc = 'desc';
	public int $perPage = 15;
	public ?array $selected = [];
	//public PaginatedResourceResponse $paginatedPosts;


	//Create, Edit, Delete, View Post props
	public $title, $body, $post_id, $category_id, $categoryName;
	public Post $post;
	public Collection $categories;

	//Multiple Selection props
	public array $selectedPosts = [];
	public bool $bulkDisabled = true;
	public $selectedCategory = null;

	//Update & Store Rules
	protected $rules = [
		'title'       => 'required|min:6',
		'body'        => 'required|min:6',
		'category_id' => 'required',
	];

	protected $validationAttributes = [
		'category_id'      => 'Category',
		'selectedCategory' => 'Category',
	];

	protected $messages = [
		'category_id.required' => 'Please select the post category.',
	];

	protected $paginationTheme = 'bootstrap';


	public function render()
	{
		$paginatedPosts = auth()->user()->search($this->query)->with('category')
			->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);
		//results count available with search only
		$this->resultCount = empty($this->query) ? null :
			$paginatedPosts->count().' '.Str::plural('post', $paginatedPosts->count()).' found';
		return view('livewire.posts.posts-table', compact('paginatedPosts'));
	}

	//Toggle the $bulkDisabled on or off based on the count of selected posts
	public function updatedselectedPosts()
	{
		$this->bulkDisabled = count($this->selectedPosts) < 2;
		$this->post = null;
	}

	public function store()
	{
		//$this->authorize('create', Post::class);
		$this->validate();
		Post::create([
			'title'       => $this->title,
			'body'        => $this->body,
			'user_id'     => auth()->user()->id,
			'category_id' => $this->category_id,
		]);
		$this->refresh('Post successfully created!', 'createModal');
	}

	//Get & assign selected post props
	public function initData(Post $post)
	{
		// assign values to public props
		$this->post = $post;
		$this->title = $post->title;
		$this->body = $post->body;
		$this->post_id = $post->id;
		$this->category_id = $post->category_id;
		$this->categoryName = $post->category->name;
		$this->selectedPosts = [];
	}

	//Get & assign selected category
	public function initDataBulk()
	{
		$this->selectedCategory = Post::findMany($this->selectedPosts)
			->map(fn($post) => $post->category->id)
			->unique()
			->pipe(fn($categories) => $categories->count() === 1 ? $categories->first() : null);
	}

	public function update()
	{
		$this->authorize('update', $this->post);
		$this->validate();
		$this->post->update(['title' => $this->title, 'body' => $this->body, 'category_id' => $this->category_id]);
		$this->refresh('Post successfully updated!', 'editModal');
	}

	//Bulk update
	public function updateBulk()
	{
		$this->authorize('updateSelected', [Post::class, $this->selectedPosts]);
		$this->validate([
			'selectedCategory' => 'required',
		]);
		Post::whereIn('id', $this->selectedPosts)->update(['category_id' => $this->selectedCategory]);
		$this->refresh('Posts successfully updated!', 'editBulkModal');
	}

	public function delete()
	{
		if ( ! empty($this->selectedPosts))
		{
			$this->authorize('deleteSelected', [Post::class, $this->selectedPosts]);
			Post::destroy($this->selectedPosts);
		}
		if ( ! empty($this->post))
		{
			$this->authorize('delete', $this->post);
			$this->post->delete();
		}
		$this->refresh('Successfully deleted!', 'deleteModal');
	}

	public function refresh($message, $modal)
	{
		//Close the active modal
		$this->emit('cancel', $modal);
		//Flash the message to the session
		session()->flash('message', $message);
		//reset props
		$this->selectedCategory = null;
		$this->selectedPosts = [];
		$this->bulkDisabled = true;
		//Refresh the livewire component
		$refresh;
	}

	public function mount()
	{
		$this->categories = Category::get();
	}

	public function hydrate()
	{
		$this->resetErrorBag();
	}
}
