<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostDelete extends Component
{
	use AuthorizesRequests;

	public $post;
	public $selected;
	protected $listeners = ['initDelete','initBulkDelete', 'delete','deleteSelected'];

	public function initDelete(Post $post)
	{
		// assign values to public props
		$this->post = $post;
	}

	public function initBulkDelete($selected)
	{
		// assign values to public props
		$this->selected = $selected;
	}

	public function delete()
	{
		if(!empty($this->selected)){
			$this->authorize('deleteSelected',[Post::class,$this->selected]);
			Post::destroy($this->selected);
		}
		if(!empty($this->post)){
			$this->authorize('delete', $this->post);
			$this->post->delete();
		}
		$this->emit('cancel','deleteModal');
		$this->emitUp('refresh','Successfully deleted!');
	}

    public function render()
    {
        return view('livewire.posts.post-delete');
    }
}
