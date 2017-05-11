<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Post;

class PostTransformer extends TransformerAbstract {

    /**
     * Serializa dos dados do post
     *
     * @param  Post  $post
     */
    public function transform(Post $post)
    {
        return [
            'id'        => $post->id,
            'published' => $post->published,
            'title'     => $post->title,
            'body'      => $post->body,
            'category'  => $post->category,
            'author'    => $post->author->name
        ];
    }
}
