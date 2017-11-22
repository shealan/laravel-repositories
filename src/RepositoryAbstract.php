<?php

namespace WesMurray\Repositories;

use WesMurray\Repositories\{
    RepositoryInterface,
    Exceptions\NoModelDefined,
    Criteria\CriteriaInterface,
    Traits\Criteria\CriteriaTrait,
    Traits\RepositoryAbstractMethodsTrait
};

abstract class RepositoryAbstract implements RepositoryInterface, CriteriaInterface
{
    use RepositoryAbstractMethodsTrait, CriteriaTrait;
    
    protected $model;
    
    public function __construct()
    {
        $this->model = $this->resolveModel();
    }
    
    protected function resolveModel()
    {
        if (! method_exists($this, 'model')) {
            throw new NoModelDefined();
        }
        
        return app()->make($this->model());
    }
}