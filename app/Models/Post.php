<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'id',
        'published',
        'title',
        'body',
        'category',
	];

	/**
	 * Retorna todas as posts.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id')->withTrashed();
	}
}
