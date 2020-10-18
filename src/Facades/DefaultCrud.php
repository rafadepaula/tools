<?php

namespace Rafadepaula\Tools\Facades;

use App\Http\Requests\CustomRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;


trait DefaultCrud
{

	public function __construct(){
		$this->model = new $this->model;
		$this->modelName = strtolower(str_replace('Controller', '', get_class()));
		$this->modelName = explode('\\', $this->modelName);
		$this->modelName = $this->modelName[count($this->modelName) - 1];
		if(empty($this->icon))
			$this->icon = 'pe-7s-home';
		if(empty($this->title))
			$this->title = 'CRUD';
		if(empty($this->headers))
			$this->headers = ['id' => '#', 'title' => 'Nome'];
		if(empty($this->useMedia))
			$this->useMedia = false;
	}

	protected abstract function formFields();

	protected abstract function validateFields(CustomRequest $request, $id = null);

	public function index()
	{
		$data = $this->model::all();
		$table = TableList::defaultTable($data, $this->headers, $this->modelName);

		return view('pages.default.index', [
			'title' => $this->title, 'icon' =>  $this->icon, 'table' => $table,
			'options' => ['title' => 'Cadastrar novo', 'url' => route($this->modelName.'_form')]
		]);
	}

	public function mapValues($fields, $model)
	{
		foreach($fields as &$row){
			foreach($row as &$field) {
				$name = $field['name'];
				if(!isset($field['value']))
					$field['value'] = $model->{$name} ?? '';
			}
		}
		return $fields;
	}

	public function form(CustomRequest $request, $id = null)
	{
		$model = empty($id) ? $this->model : $this->model::findOrFail($id);
		$fields = $this->formFields();
		$fields = $this->mapValues($fields, $model);

		$route = $this->modelName;
		$options = [
			'title' => 'Voltar para listagem',
			'url' => route($this->modelName.'_index')
		];
		$vars = [
			'title' => 'Cadastro - '.$this->title,
			'icon' => $this->icon, 'fields' => $fields,
			'route' => $route, 'model' => $this->model,
			'options' => $options
		];
		return view('pages.default.form', $vars);
	}

	public function errorForm($message = '', $type = '')
	{
		if(empty($message))
			$message = 'Erro ao salvar os dados do formulário.';
		if(empty($type))
			$type = 'danger';
		DB::rollBack();
		flash($message, $type);
		redirect(URL::previous())->withInput();
	}

	public function save(CustomRequest $request, $id = null)
	{
		$this->validateFields($request, $id);
		$fields = $request->all();
		DB::beginTransaction();

		$model = $this->model::updateOrCreate(['id' => $id], $fields);

		if(!$model){
			return $this->errorForm();
		}
		if($this->useMedia) {
			if (!$this->saveMedias($request, $model)) {
				return $this->errorForm('Erro ao salvar as mídias.');
			}
		}

		DB::commit();
		flash('Informações salvas com sucesso.', 'success');
		redirect()->route($this->modelName.'_index');
	}

	public function delete($id)
	{
		$model = $this->model::findOrFail($id);
		$model->delete();
		flash('Informações deletadas com sucesso.', 'success');
		redirect()->route($this->modelName.'_index');
	}

}