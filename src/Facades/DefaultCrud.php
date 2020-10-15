<?php

namespace Rafadepaula\Tools\Facades;

use Illuminate\Database\Eloquent\Collection;
use Rafadepaula\Tools\Facades\TableList;

trait DefaultCrud
{
    protected $headers = ['id' => '#', 'title' => 'Nome'];

    public function __construct(){
        $this->model = new $this->model;
        $this->modelName = str_replace('Controller', '', get_class());
    }

    public function index()
    {
        $table = TableList::defaultTable($data, $this->$headers, $this->modelName);

        return view('pages.default.index', [
            'title' => $this->title, 'icon' =>  'pe-7s-home', 'table' => $table,
            'options' => ['title' => 'Cadastrar novo', url => route($this->modelName.'_add')]
        ]);
    }

}