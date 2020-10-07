<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
	{
		$data = User::all();
		$header = ['id' => '#', 'email' => 'E-mail'];

		$users = User::prepareTable($data, $header);
		$users['options'] = [
			['label' => 'Editar', 'route' => 'user_edit'],
			['label' => 'Deletar', 'route' => 'user_delete', 'confirm' => true, 'class' => 'btn-warning']
		];

		return view('pages.user.index')->with('users', $users);
	}

	public function add()
	{
		return view('pages.user.form')
			->with('user', new User());
	}

	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('pages.user.form')
			->with('user', $user);
	}

	public function validateParams(Request $request, $id)
	{
		$uniqueRule = '|unique:users,email'.(!empty($id) ? ','.$id : '');
		$rules = [
			'email' => 'required|email|max:255'.$uniqueRule,
			'password' => 'nullable|confirmed',
		];
		$messages = [
			'required' => 'O atributo :attribute é obrigatório',
			'max' => 'O atributo :attribute deve conter até :max caracteres',
			'confirmed' => 'Senhas não conferem',
			'unique' => 'E-mail já está sendo utilizado por outro usuário',
			'email' => 'Informe um e-mail válido',
		];
		$request->validate($rules, $messages);
		return true;
	}

	public function save(Request $request, $id = null)
	{
		if(!$this->validateParams($request, $id))
			return;
		$fields = $request->all();

		if(empty($id))
			$fields['password'] = Hash::make($fields['password']);
		else
			unset($fields['password']);

		$user = User::updateOrCreate(['id' => $id], $fields);

		flash('Usuário '.$user->email.' salvo com sucesso.', 'success');
		return $this->index();
	}

	public function delete($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		flash('Usuario '.$user->email.' deletado com sucesso.', 'success');
		return $this->index();
	}
}
