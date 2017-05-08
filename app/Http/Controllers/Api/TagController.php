<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Tag\DeleteTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    private $model;

    /**
     * UserController constructor.
     * @param $model
     */
    public function __construct(Tag $model)
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
        $data['tags'] = $this->model->all();
        $data['total'] = $data['tags']->count();

        return $data['users']->isEmpty()
            ? json_response(false, 404, 'Não foi possivel obter a lista de tags ou não há tags cadastradas no momento.')
            : json_response(true, 200,'Lista de tags cadastradas.',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $tag = $this->model->create([
            'name' => $request->input('name')
        ]);
        return !$tag
            ? json_response(false, 404, 'Não foi possível registrar esta tag.')
            : json_response(true, 200, 'Tag criada com sucesso.', compact('tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = $this->model->where('id', $id)->first();
        return !$tag
            ? json_response(false, 404,'Tag não encontrada.')
            : json_response(true, 200,'Tag encontrada', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $this->model->where('id', $id)->first();

        if(!$tag){
            return json_response(false, 404, 'Tag não encontrada.');
        }

        $hasUpdated = $tag->update([
            'name' => $request->input('name')
        ]);

        return !$hasUpdated
            ? json_response(false, 404, 'Não foi possível atualizar os dados desta tag.')
            : json_response(true, 200,'Informações da tag foram atualizadas.', null  );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param DeleteUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteTagRequest $request)
    {
        if(!$request->input('confirmation'))
            return json_response(false, 404, 'É preciso confirmar esta operação para excluir um registro.');

        $tag = $this->model->where('id', $id)->first();

        if(!$tag) return json_response(false, 404, 'Tag não encontrada');

        $hasDeleted = $tag->destroy($id);
        return !$hasDeleted
            ? json_response(false, 404, 'Não é possível deletar esta tag.')
            : json_response(true, 200, 'Tag foi deletada.');
    }
}
