<?php


namespace Rafadepaula\Facade\Tools;


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
}