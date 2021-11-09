<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    // model tuong tac 
    protected $model;

    // khoi tao 
    public function __contruct()
    {
        $this->setModel();
    }

    // lay model tuong ung 
    abstract public function getModel();

    /* 
    * set model 
    */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function  getAll()
    {
        return $this->model->paginate(50);
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($arrtribute = [])
    {
        return $this->model->create($arrtribute);
    }

    public function update($id, $arrtribute = [])
    {
        $result = $this->model->find($id);
        if($result)
        {
            $result->update($arrtribute);
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->model->find($id);
        if($result)
        {
            $result->delete();

            return true;
        }
        return false;
    }

    


}