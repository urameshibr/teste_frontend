<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $model;

    /**
     * UserController constructor.
     * @param $model
     */
    public function __construct(User $model)
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
        $data['users'] = $this->model->all();
        $data['total'] = $data['users']->count();

        return $data['users']->isEmpty()
            ? json_response(false, 404, 'Não foi possivel obter a lista de usuários ou não há usuários cadastrados no momento.')
            : json_response(true, 200,'Lista de usuários cadastrados.',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->model->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return !$user
            ? json_response(false, 404, 'Não foi possível registrar o usuário.')
            : json_response(true, 200, 'Usuário criado com sucesso.', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->model->where('id', $id)->first();
        return !$user
            ? json_response(false, 404,'Usuário não encontrado.')
            : json_response(true, 200,'Usuário encontrado', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->model->where('id', $id)->first();

        if(!$user){
            return json_response(false, 404, 'Usuário não encontrado.');
        }

        $hasUpdated = $user->update([
            'name' => $request->input('name')
        ]);

        return !$hasUpdated
            ? json_response(false, 404, 'Não foi possível atualizar os dados do usuário.')
            : json_response(true, 200,'Informações de usuário foram atualizadas.', null  );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param DeleteUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteUserRequest $request)
    {
        if(!$request->input('confirmation'))
            return json_response(false, 404, 'É preciso confirmar esta operação para excluir um registro.');

        $user = $this->model->where('id', $id)->first();

        if(!$user) return json_response(false, 404, 'Usuário não encontrado');

        $hasDeleted = $user->destroy($id);
        return !$hasDeleted
            ? json_response(false, 404, 'Não é possível deletar este usuário.')
            : json_response(true, 200, 'Usuário foi deletado.');
    }

    public function posts()
    {
        $userPosts = $this->model->posts();
        return !$userPosts
            ? json_response(false, 404, 'Não foram encontrados artigos para este usuário.')
            : json_response(true, 200, 'Lista de artigos do usuário.', $userPosts);
    }
}
