<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param User $user
	 *
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param User $user
	 * @param Post $post
	 *
	 * @return mixed
	 */
	public function view(User $user, Post $post)
	{
		return $post->user_id === $user->id;
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param User $user
	 *
	 * @return mixed
	 */
	public function create(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param User $user
	 * @param Post $post
	 *
	 * @return mixed
	 */
	public function update(User $user, Post $post)
	{
		return $post->user_id === $user->id;
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param User $user
	 * @param Post $post
	 *
	 * @return mixed
	 */
	public function delete(User $user, Post $post)
	{
		return $user->id === $post->user_id;
	}

	/**
	 * Determine whether the user can bulk delete the model.
	 *
	 * @param User $user
	 * @param array $postIds
	 *
	 * @return mixed
	 */
	public function deleteSelected(User $user, $postIds)
	{
		//return $user->id === $post->user_id;
		return Post::findMany($postIds)->contains('user_id', $user->id);
	}

	/**
	 * Determine whether the user can bulk update the model.
	 *
	 * @param User $user
	 * @param array $postIds
	 *
	 * @return mixed
	 */
	public function updateSelected(User $user, $postIds)
	{
		//return $user->id === $post->user_id;
		return Post::findMany($postIds)->contains('user_id', $user->id);
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param User $user
	 * @param Post $post
	 *
	 * @return mixed
	 */
	public function restore(User $user, Post $post)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param User $user
	 * @param Post $post
	 *
	 * @return mixed
	 */
	public function forceDelete(User $user, Post $post)
	{
		//
	}
}
