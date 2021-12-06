<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $models;
    public function __construct(Model $models)
    {
        $this->models = $models;
    }

    public function getAll()
    {
        return $this->models->all();
    }

    public function getById($id)
    {
//        dd($this->models->find($id));
        return $this->models->find($id);
//        return $this->models->findOrFail($id);
    }

}
