<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostEdit extends Component
{
	use AuthorizesRequests;

	public $post, $title, $body, $post_id;
	protected $listeners = ['initEdit', 'update'];

	protected $rules = [
		'title' => 'required|min:6',
		'body'  => 'required|min:6',
	];

	public function initEdit(Post $post)
	{
		// assign values to public props
		$this->post = $post;
		$this->title = $post->title;
		$this->body = $post->body;
		$this->post_id = $post->id;
	}

	public function hydrate()
	{
		$this->resetErrorBag();
	}

	public function update()
	{
		$this->authorize('update', $this->post);
		$this->validate();
		$this->post->update(['title'=>$this->title,'body'=>$this->body]);
		$this->emit('cancel','editModal');
		$this->emitUp('refresh','Post successfully updated!');
	}


	public function render()
	{
		return view('livewire.posts.post-edit');
	}
}
