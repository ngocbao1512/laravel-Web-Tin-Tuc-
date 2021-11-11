<?php
namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($request);

    public function update($request);

    public function delete($id);

}