<?php


namespace Rafadepaula\Tools\Facades;


use Illuminate\Support\Facades\Route;

class Routes
{

	protected static $debug;
	protected static $registered = [];

	public static function enableDebug()
	{
		self::$debug = true;
	}

	public static function registerDebug($route){
		self::$registered[$route['method']][] = $route;
	}

	public static function getDebug($print = false){
		if($print)
			print_r(self::$registered);
		return self::$registered;
	}

	/**
	 * Formato:
	 * [
	 * 	'controller' => [
	 * 		'prefix' => '<prefixo da url, por exemplo /usuarios para ser completo por /add, /edit, etc>,
	 * 		'TIPO DA REQUEST' => [
	 * 			['url da rota do tipo da request', 'nome da rota'], ['url da rota', 'nome da rota']...
	 * 		],
	 * 		'defaultCruds' => true/false (cria automaticamente os get e post pra CRUDs)
	 * ]
	 *
	 * Se for informado "withModel", o id do model do controller principal deve estar presente na requisição e será passado
	 * no parâmetro "id".
	 *
	 *
	 * @param $routes
	 * @param bool $withModel
	 */
	public static function registerRoutes($routes, $withModel = false){
		$methods = ['get', 'post', 'delete'];
		foreach($routes as $controller => $opts){
			$model = lcfirst($controller);
			$prefixName = !empty($opts['prefixName']) ? $opts['prefixName'] : $model;
			$prefix = $opts['prefix'];
			$defaultCrud = isset($opts['defaultCrud']) && $opts['defaultCrud'];

			foreach($methods as $method){
				$urls = !empty($opts[$method]) ? $opts[$method] : [];
				if($defaultCrud)
					$urls = self::mergeDefaultCrud($urls, $method);

				if(!empty($urls)){
					foreach($urls as $urlOpts){
						$url = $prefix.$urlOpts[0];
						$action = $controller.'Controller@'.self::dashesToCamelCase($urlOpts[1]);
						$name = $prefixName.'_'.$urlOpts[1];
						if($withModel) {
							Route::{$method}($url, $action)->defaults('model', $model)->name($name);
							if(self::$debug) {
								self::registerDebug([
									'method' => $method,
									'url' => $url,
									'action' => $action,
									'model' => $model,
									'name' => $name,
								]);
							}
						}else {
							Route::{$method}($url, $action)->name($name);
							if(self::$debug) {
								self::registerDebug([
									'method' => $method,
									'url' => $url,
									'action' => $action,
									'name' => $name,
								]);
							}
						}
					}
				}
			}
		}
	}


	public static function mergeDefaultCrud($urls, $method){
		$defaultCrud = [
			'get' => [
				['', 'index'],
				['/formulario/{id?}', 'form'],
				['/deletar/{id}', 'delete']
			],
			'post' => [['/salvar/{id?}', 'save']],
		];
		if(!empty($defaultCrud[$method])) {
			$urls = array_merge($urls, $defaultCrud[$method]);
		}
		return $urls;
	}

	public static function dashesToCamelCase($string, $capitalizeFirstCharacter = false){

		$str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

		if (!$capitalizeFirstCharacter) {
			$str = lcfirst($str);
		}

		return $str;
	}
}