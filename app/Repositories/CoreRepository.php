<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

//Репозиторий работы с сущностью ,
//может выдавать наборы данных
//не может создавать или изменять сущности
abstract  class CoreRepository{
    /**
     * @var Model
     */
    protected  $model;

    public function __construct(){
        $this->model = app($this->getModelClass());
    }
    abstract protected function getModelClass();
    protected function startConditions(){
        return clone $this->model;
    }
}
