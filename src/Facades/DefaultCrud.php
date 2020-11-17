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
		if(!empty($this->routePrefix))
			$this->modelName = $this->routePrefix;
		if(empty($this->icon))
			$this->icon = 'pe-7s-home';
		if(empty($this->title))
			$this->title = 'CRUD';
		if(empty($this->headers))
			$this->headers = ['id' => '#', 'title' => 'Nome'];
		if(empty($this->useMedia))
			$this->useMedia = false;
	}

	protected abstract function formFields($model);

	protected abstract function validateFields(CustomRequest $request, $id = null);

	protected function assets(){
		return [];
	}

	protected function attachablesFields(){
		return [];
	}

	protected function options()
	{
		return null;
	}

	public function index()
	{
		$data = $this->model::all();
		$table = TableList::defaultTable($data, $this->headers, $this->modelName);
		if(!empty($this->options()))
			$table['options'] = $this->options();


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
		$fields = $this->formFields($model);
		$fields = $this->mapValues($fields, $model);
		$route = $this->modelName;
		$options = [
			'title' => 'Voltar para listagem',
			'url' => route($this->modelName.'_index')
		];
		$vars = [
			'title' => 'Cadastro - '.$this->title,
			'icon' => $this->icon, 'fields' => $fields,
			'route' => $route, 'model' => $model,
			'options' => $options, 'assets' => $this->assets()
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
		return redirect(URL::previous())->withInput();
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
		$this->syncAttach($request, $model);
		if(method_exists($this, 'beforeSaveSuccess'))
			$this->beforeSaveSuccess($model, $request);
		DB::commit();
		flash('Informações salvas com sucesso.', 'success');
		if(method_exists($this, 'onSaveSuccess'))
			$this->onSaveSuccess($model, $request);
		return redirect()->route($this->modelName.'_form', $model->id);
	}

	private function syncAttach($request, $model){
		$attachables = $this->attachablesFields();
		foreach($request->all() as $field => $values){
			if(array_key_exists($field, $attachables)){
				$attachableInfo = $attachables[$field];
				if(is_array($attachableInfo)) {
					$attachModel = $attachableInfo['model'];
					if ($attachableInfo['type'] == 'value')
						$ids = $this->syncAttachIdsByValue($values, $attachModel);
					else
						$ids = $this->syncAttachIds($values, $attachModel);
				}else{
					$ids = $this->syncAttachIds($values, $attachableInfo);
				}

				$model->{$field}()->sync($ids);
			}
		}
	}

	private function syncAttachIds($values, $attachModel){
		$ids = [];
		if(!empty($values)){
			if(!is_array($values))
				$values = [$values];
			foreach($values as $value){
				if(!ctype_digit($value)) {
					$resultAttach = $attachModel::create(['value' => $value]);
					$resultAttach->save();
					$ids[] = $resultAttach->id;
				}else{
					$ids[] = $value;
				}
			}
		}
		return $ids;
	}

	private function syncAttachIdsByValue($values, $attachModel){
		$ids = [];
		if(!empty($values)){
			if(!is_array($values))
				$values = [$values];
			foreach($values as $value){
				$resultAttach = $attachModel::firstOrNew(['value' => $value]);
				$ids[] = $resultAttach->id;
			}
		}
		return $ids;
	}

	public function delete($id)
	{
		$model = $this->model::findOrFail($id);

		if($this->useMedia && !empty($model->gallery)) {
			foreach ($model->gallery->medias()->get() as $media) {
				$this->deleteMedia($media->id);
			}
		}

		foreach($this->attachablesFields() as $relation => $class){
			$model->{$relation}()->sync([]);
		}

		$model->delete();

		if(!empty($model->gallery))
			$model->gallery->delete();

		flash('Informações deletadas com sucesso.', 'success');
		return redirect()->route($this->modelName.'_index');
	}

}