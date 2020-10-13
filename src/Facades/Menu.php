<?php


namespace Rafadepaula\Tools\Facades;


class Menu
{
	public static function generate()
	{
		$menusResult = array();
		$menus = config('menu');
		return view('rafadepaula::menu', [
			'menus' => $menus['menus']['default'],
			'headClass' => $menus['heading_class'],
			'iconClass' => $menus['icons_class'],
		]);
	}
}