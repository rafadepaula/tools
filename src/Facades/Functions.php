<?php


namespace Rafadepaula\Tools\Facades;


use Illuminate\Support\Facades\Storage;

class Functions
{
	/**
	 * Calcula em MB o armazenamento do storage
	 * @param string $folder
	 * @return false|float
	 */
	public static function calcStorageUsage($folder = ''){
		$totalSize = 0;
		$files = Storage::files($folder);
		foreach($files as $file) {
			$totalSize += Storage::size($file); // bytes
		}
		$totalSize = $totalSize / 1000; // kbytes
		$totalSize = round(($totalSize / 1000), 2); // mbytes

		return $totalSize;
	}

	public static function moneyToDecimal($string, $sep = '.', $dec = ','){
		$string = trim(str_replace('R$', '', $string));
		$string = str_replace($sep, '', $string);
		$string = str_replace($dec, '.', $string);
		return $string;
	}

	public static function decimalToMoney($decimal, $prefix = 'R$ '){
		return $prefix.number_format($decimal, 2, ',', '.');
	}

	public static function removeArrayValue(array $array, $value)
	{
		$index = array_search($value, $array);
		if($index !== false)
			unset($array[$index]);
		return $array;
	}
}