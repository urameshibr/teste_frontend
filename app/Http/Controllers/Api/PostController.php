<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\SearchPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $model;

    /**
     * PostController constructor.
     * @param $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['posts'] = $this->model->with('user')->get();
        $data['total'] = $data['posts']->count();

        return $data['posts']->isEmpty()
            ? json_response(false, 404, 'Não foi possivel obter a lista de artigos ou não há artigos cadastrados no momento.')
            : json_response(true, 200, 'Lista de artigos cadastrados.', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->model->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
        ]);
        return !$post
            ? json_response(false, 404, 'Não foi possível registrar o artigo.')
            : json_response(true, 200, 'Arrtigo criado com sucesso.', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->model->where('id', $id)->first();
        return !$post
            ? json_response(false, 404, 'Artigo não encontrado.')
            : json_response(true, 200, 'Artigo encontrado', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->model->where('id', $id)->first();

        if (!$post) {
            return json_response(false, 404, 'Artigo não encontrado.');
        }

        $hasUpdated = $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
        ]);

        return !$hasUpdated
            ? json_response(false, 404, 'Não foi possível atualizar os dados do artigo.')
            : json_response(true, 200, 'Informações do artigo foram atualizadas.', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param DeleteUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeletePostRequest $request)
    {
        if (!$request->input('confirmation'))
            return json_response(false, 404, 'É preciso confirmar esta operação para excluir um registro.');

        $post = $this->model->where('id', $id)->first();

        if (!$post) return json_response(false, 404, 'Artigo não encontrado');

        $hasDeleted = $post->destroy($id);
        return !$hasDeleted
            ? json_response(false, 404, 'Não é possível deletar este artigo.')
            : json_response(true, 200, 'Artigo foi deletado.');
    }

    public function search(SearchPostRequest $request)
    {
        $posts = DB::select("
            select DISTINCT p.* from posts p, post_tag pt, tags t
            WHERE t.id = pt.tag_id and p.id = pt.post_id and ( p.title like '{$request->input('filter')}' 
            or t.name like '{$request->input('filter')}')
        ");
        return !$posts
            ? json_response(false, 404, 'Nenhum artigo foi encontrado.')
            : json_response(true, 200, 'Lista de artigos.', $posts);
    }
}

