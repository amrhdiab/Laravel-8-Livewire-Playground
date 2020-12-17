<?php /** @noinspection ALL */

/** @noinspection PhpUndefinedVariableInspection */

namespace App\Http\Livewire\Posts;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class PostsTable extends Component
{
	use WithPagination;

	public ?string $query = null;
	public ?string $resultCount;
	public string $orderBy = 'created_at';
	public string $orderAsc = 'desc';
	public int $perPage = 15;
	public ?array $selected = [];

	protected $paginationTheme = 'bootstrap';
	protected $listeners = ['refresh' => 'refresh'];


	public function render()
	{
		$posts = auth()->user()->search($this->query)
			->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);
		//results count available with search only
		$this->resultCount = empty($this->query) ? null :
			$posts->count().' '.Str::plural('post', $posts->count()).' found';

		return view('livewire.posts.posts-table', compact('posts'));
	}

	public function refresh($message)
	{
		session()->flash('message', $message);
		$refresh;

	}
}
