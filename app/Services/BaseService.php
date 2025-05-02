<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function listar(array $relaciones = []): Builder
    {
        return $this->model->query()->with($relaciones);
    }

    public function mostrar(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function crear(array $data)
    {
        return $this->model->create($data);
    }

    public function editar(array $data, int $id)
    {
        $model = $this->mostrar($id);
        return $model->update($data);
    }

    public function eliminar(int $id)
    {
        $model = $this->mostrar($id);
        $model->estatus = 'Inactivo';
        return $model->save();
    }

    public function conRelaciones(array $relaciones): Builder
    {
        return  $this->model->with($relaciones);
    }
}
