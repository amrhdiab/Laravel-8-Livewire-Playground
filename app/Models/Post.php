<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	protected $fillable = ['title', 'body', 'user_id', 'category_id', 'thumbnail'];
	protected $attributes = [
		'thumbnail' => 'post-thumb.jpg',
	];

	public function user()
	{
		return $this->belongsTo('App\models\User');
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public static function search($query)
	{
		return empty($query) ? static::query() :
			static::query()->where('user_id', auth()->user()->id)
				->where('title', 'like', '%'.$query.'%');
	}
}
