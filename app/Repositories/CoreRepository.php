<?php

namespace App\Repositories;

abstract class CoreRepository
{
    protected mixed $model;
    protected array $fields;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
        $this->fields = $this->selectFields();
    }

    abstract protected function getModelClass();

    public function startConditions()
    {
        return clone $this->model;
    }

    protected function selectFields(): array
    {
        return array_merge(['id'], $this->model->getFillable());
    }

    public function search(string $term)
    {
        $query = $this->startConditions();

        foreach ($this->getSearchableFields() as $field) {
            $query->orWhere($field, 'ILIKE', "%{$term}%");
        }

        return $query;
    }
    protected function getSearchableFields(): array
    {
        return $this->model->getFillable();
    }
}
