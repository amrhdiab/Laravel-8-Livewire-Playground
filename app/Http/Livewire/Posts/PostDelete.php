<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostDelete extends Component
{
	use AuthorizesRequests;

	public $post;
	protected $listeners = ['initDelete', 'delete'];

	public function initDelete(Post $post)
	{
		// assign values to public props
		$this->post = $post;
	}

	public function delete()
	{
		$this->authorize('delete', $this->post);
		$this->post->delete();

		$this->emit('cancel','deleteModal');
		$this->emitUp('refresh','Post successfully deleted!');
	}

    public function render()
    {
        return view('livewire.posts.post-delete');
    }
}
