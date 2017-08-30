<?php

namespace App\Services;

use App\Models\Post;
use App\Transformers\PostTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Fractal;

class PostService
{   
    /**
     * @var Post
     */
    protected $posts;

    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $paginator = $this->posts->paginate(5);
        $companies = $paginator->getCollection();

        return Fractal::collection($companies)
                ->transformWith(new PostTransformer())
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function save($request, $id = null)
    {
        $user = \Auth::user();

        if ($id) {
            $post = $this->posts->findOrFail($id);

            $post->fill($request->all())->save();
        } else {
            $post = $user->posts()->create($request->all());
        }

        return Fractal::create($post)
                ->transformWith(new PostTransformer())
                ->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $post = $this->posts->findOrFail($id);

        return Fractal::create($post)
                ->transformWith(new PostTransformer())
                ->toArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = $this->posts->findOrFail($id);

        $post->delete();
    }
}
