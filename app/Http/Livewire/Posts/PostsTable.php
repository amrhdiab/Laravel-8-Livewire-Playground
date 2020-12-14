<?php /** @noinspection PhpUndefinedVariableInspection */

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;

class PostsTable extends Component
{
	use WithPagination;

	public $query;
	public $orderBy = 'created_at';
	public $orderAsc = 'desc';
	public $perPage = 5;
	protected $paginationTheme = 'bootstrap';
	protected $listeners = ['refresh' => 'refresh'];


	public function render()
	{
		$posts = auth()->user()->search($this->query)
			->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

		return view('livewire.posts.posts-table', compact('posts'));
	}

	public function refresh($message)
	{
		session()->flash('message', $message);
		$refresh;

	}
}
