<?php

namespace Rafadepaula\Tools\Facades\Traits;


use Illuminate\Database\Eloquent\Collection;

trait Listable
{

	/**
	 * Monta o array para mostrar as informações de listagem de registros no elemento "elements.table"
	 * @param Collection $data - Coleção do Eloquent dos dados a serem mostrados
	 * @param array $headers - Array
	 * @param string $id - Nome da coluna de identificação principal da linha
	 * @param array|null $transformation - array de funções para mascarar colunas se necessário (['coluna' => funcao()])
	 * @return array estruturado para mostrar listagem de registros na tela
	 */
	static function prepareTable($data, $headers, $id = 'id', $transformation = null)
	{
		$result = ['headers' => array_values($headers), 'data' => []];
		foreach($data as $reg){
			$row = array();
			foreach(array_keys($headers) as $column){

				$column = explode('.', $column); // places.cities.title, users.cities.name...
				$info = $reg;
				foreach($column as $att) // reg->att->att...
					$info = $info->{$att};

				if(isset($transformation[implode('.', $column)]))
					$info = $transformation[implode('.', $column)]($info);

				$row[] = $info;
			}
			$row['_id'] = $reg->{$id};
			$result['data'][] = $row;
		}
		return $result;
	}
}
