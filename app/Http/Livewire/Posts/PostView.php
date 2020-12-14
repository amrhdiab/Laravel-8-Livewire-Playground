<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostView extends Component
{
	use AuthorizesRequests;

	public $post,$title,$body;
	protected $listeners = ['initView'];

	public function initView(Post $post)
	{
		//$this->authorize('view', $this->post);
		// assign values to public props
		$this->post = $post;
		$this->title = $post->title;
		$this->body = $post->body;
	}

    public function render()
    {
        return view('livewire.posts.post-view');
    }
}
