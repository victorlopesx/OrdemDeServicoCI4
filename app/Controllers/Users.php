<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Entities\User;

use Config\Services;

class Users extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Usuários do sistema',
        ];

        return view('Users/index', $data);
    }

    public function printUsers()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $attributes = [
            'id',
            'avatar',
            'name',
            'email',
            'active',
        ];

        $users = $this->userModel->select($attributes)
            ->orderBy('id', 'DESC')
            ->findAll();

        //array de objetos de usuáros
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'avatar' => $user->avatar,
                'name' => anchor("users/show/$user->id", esc($user->name), 'title="Visualizar perfil"'),
                'email' => esc($user->email),
                'active' => ($user->active == true ? 'Ativo' : '<span class="text-warning">Inativo</span>'),
            ];
        };

        $print = [
            'data' => $data,
        ];

        return $this->response->setJSON($print);
    }

    public function create(int $id = null)
    {
        $user = new User();

        $data = [
            'title' => 'Criar novo usuário ',
            'user' => $user,
        ];

        return view('users/create', $data);
    }

    public function userCreated()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // envio hash do token do form
        $retorno['token'] = csrf_hash();

        // recupera o post da requisição
        $post = $this->request->getPost();

        // criando um novo objeto da entidade usuário
        $user = new User($post);

        if ($this->userModel->protect(false)->save($user)) {

            $btnNewUser = anchor('users/create', 'Cadastrar novo usuário', ['class' => 'btn btn-danger mt-2']);

            session()->setFlashdata('success', "Usuário cadastrado com sucesso. $btnNewUser ");



            // retornamos o último id inserido na tabela do usuário (usuário recém criado)
            $retorno['id'] = $this->userModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        $retorno['error'] = 'Por favor, verifique os erros e tente novamente.';
        $retorno['errors_model'] = $this->userModel->errors();


        // retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function show(int $id = null)
    {
        $user = $this->searchUserOr404($id);

        $data = [
            'title' => 'Usuário ' . esc($user->name),
            'user' => $user,
        ];

        return view('users/show', $data);
    }

    public function edit(int $id = null)
    {
        $user = $this->searchUserOr404($id);

        $data = [
            'title' => 'Editar o usuário ' . esc($user->name),
            'user' => $user,
        ];

        return view('users/edit', $data);
    }



    public function update()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // envio hash do token do form
        $retorno['token'] = csrf_hash();

        // recupera o post da requisição
        $post = $this->request->getPost();

        // valida a existencia do usuario
        $user = $this->searchUserOr404($post['id']);

        // se nao foi informado a senha, removemo-as do post
        // se nao houver isso, o pass sera de uma string vazia
        if (empty($post['password'])) {
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // preencher os atributos do usuário com os valores do post
        $user->fill($post);

        if ($user->hasChanged() == false) {
            $retorno['info'] = 'Não há dados para serem atualizados';
            return $this->response->setJSON($retorno);
        }

        if ($this->userModel->protect(false)->save($user)) {
            session()->setFlashdata('success', 'Dados salvos com sucesso.');
            return $this->response->setJSON($retorno);
        }

        $retorno['error'] = 'Por favor, verifique os erros e tente novamente.';
        $retorno['errors_model'] = $this->userModel->errors();


        // retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function avatar(int $id = null)
    {
        $user = $this->searchUserOr404($id);

        $data = [
            'title' => 'Alterar o usuário ' . esc($user->name),
            'user' => $user,
        ];

        return view('users/avatar', $data);
    }

    public function upload()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // envio hash do token do form
        $retorno['token'] = csrf_hash();

        $validation = \Config\Services::validation();

        $rules = [
            'avatar' => 'required|uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,jpeg,webpp]',
        ];

        $errorsmsg = [
            'uploaded' => 'Por favor, selecione uma imagem.',
            'ext_in' => 'Formato não permitido.',
            'max_size' => 'Você ultrapassou o tamanho máximo do arquivo.'
        ];

        // regras de validação para imagens/arquivos
        $validation->setRules($rules, $errorsmsg);

        if(!$validation->withRequest($this->request)->run()){
            $retorno['error'] = 'Por favor, verifique os erros e tente novamente.';
            $retorno['errors_model'] = $validation->getErrors();;

            // retorno para o ajax request
            return $this->response->setJSON($retorno);
        }

        // recupera o post da requisição
        $post = $this->request->getPost();

        // valida a existencia do usuario
        $user = $this->searchUserOr404($post['id']);

        // recuperamos a imagem do post
        $file = $this->request->getFile('avatar');

        echo '<pre>';
        print_r($file);
        exit;






        // se nao foi informado a senha, removemo-as do post
        // se nao houver isso, o pass sera de uma string vazia
        if (empty($post['password'])) {
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // preencher os atributos do usuário com os valores do post
        $user->fill($post);

        if ($user->hasChanged() == false) {
            $retorno['info'] = 'Não há dados para serem atualizados';
            return $this->response->setJSON($retorno);
        }

        if ($this->userModel->protect(false)->save($user)) {
            session()->setFlashdata('success', 'Dados salvos com sucesso.');
            return $this->response->setJSON($retorno);
        }

        $retorno['error'] = 'Por favor, verifique os erros e tente novamente.';
        $retorno['errors_model'] = $this->userModel->errors();


        // retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    // método que recupera o usuário
    private function searchUserOr404(int $id = null)
    {
        if (!$id || !$user = $this->userModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");
        }

        return $user;
    }
}
