<?php

namespace Rafadepaula\Tools\Facades;

use Illuminate\Database\Eloquent\Collection;
use Rafadepaula\Tools\Facades\TableList;

trait DefaultCrud
{
	protected $headers = ['id' => '#', 'title' => 'Nome'];

	public function __construct(){
		$this->model = new $this->model;
		$this->modelName = strtolower(str_replace('Controller', '', get_class()));
		$this->modelName = explode('\\', $this->modelName);
		$this->modelName = $this->modelName[count($this->modelName) - 1];
		if(empty($this->icon))
			$this->icon = 'pe-7s-home';
	}

	public function index()
	{
		$data = $this->model::all();
		$table = TableList::defaultTable($data, $this->headers, $this->modelName);

		return view('pages.default.index', [
			'title' => $this->title, 'icon' =>  $this->icon, 'table' => $table,
			'options' => ['title' => 'Cadastrar novo', 'url' => route($this->modelName.'_add')]
		]);
	}

	public function mapValues($fields, $model){
		foreach($fields as &$row){
			foreach($row as &$field) {
				$name = $field['name'];
				if(!isset($field['value']))
					$field['value'] = $model->{$name} ?? '';
			}
		}
		return $fields;
	}

	public function add(){
		$fields = $this->formFields();
		$fields = $this->mapValues($fields, $this->model);
		return view('pages.default.form', [
			'title' => 'Cadastro - '.$this->title, 'icon' => $this->icon, 'fields' => $fields,
			'route' => $this->modelName.'_save', 'model' => $this->model,
			'options' => ['title' => 'Voltar para listagem', 'url' => route($this->modelName.'_index')]
		]);
	}


}