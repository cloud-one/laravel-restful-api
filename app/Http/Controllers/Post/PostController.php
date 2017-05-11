<?php

namespace App\Http\Controllers\Post;

use App\Services\PostService;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Controllers\Controller;

/**
 * @resource Posts
 *
 * Descrição do recurso...
 * 
 * **Obs.:**  `Aqui aceita markdown`.
 *
 * @param ObjectService $service [description]
 */
class PostController extends Controller
{
    protected $posts;

    public function __construct(PostService $service)
    {
        $this->posts = $service;
    }

    /**
     * Listar Post
     *
     * Lista todos Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->posts->getAll();
    }

    /**
     * Criar Objeto
     *
     * Cria um novo Objeto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            $posts = $this->posts->save($request);

            return response()->json($posts, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Exibir Objeto
     *
     * Exibe um Objeto.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->posts->getById($id);
    }

    /**
     * Atualizar Objeto
     *
     * Atualiza um Objeto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $posts = $this->posts->save($request, $id);

            return response()->json($posts, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Apagar Objeto
     *
     * Remove um Objeto do banco de dados.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $posts = $this->posts->delete($id);
            return response()->json(true, 204);
        }
        catch (ModelNotFoundException $ex) {
            throw $ex;
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
