<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostCreate extends Component
{
	use AuthorizesRequests;

	public $title, $body;
	protected $listeners = ['store'];

	protected $rules = [
		'title' => 'required|min:6',
		'body'  => 'required|min:6',
	];

	public function hydrate()
	{
		$this->resetErrorBag();
	}

	public function store()
	{
		//$this->authorize('create', Post::class);
		$this->validate();
		Post::create(['title' => $this->title, 'body' => $this->body, 'user_id' => auth()->user()->id]);
		$this->emit('cancel', 'createModal');
		$this->emitUp('refresh', 'Post successfully created!');
	}

	public function render()
	{
		return view('livewire.posts.post-create');
	}
}
