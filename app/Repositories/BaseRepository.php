<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    // model tuong tac 
    protected $model;

    // khoi tao 
    public function __construct()
    {
        $this->setModel();
    }

    // lay model tuong ung 
    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function  getAll()
    {   
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($request)
    {
        $request->all();
        return $this->model->create($request);
    }

    public function update($request)
    {
        $result = $this->model->find($request->userid);
        if($result)
        {
            $result->update($request->all());
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

    /*
    * input array database to create update model 
    * if one of element is null 
    * return of this element
    */
    public function IsNullElementInArray($arr = [])
    {
        foreach($arr as $key => $element)
        {
            if ($element == null){
                return $key;
            }
        }
    }
}