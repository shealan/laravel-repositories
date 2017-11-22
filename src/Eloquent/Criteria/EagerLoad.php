<?php

namespace WesMurray\Repositories\Eloquent\Criteria;

use WesMurray\Repositories\Criteria\CriterionInterface;

class EagerLoad implements CriterionInterface
{
    protected $relations;
    
    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }
    
    public function apply($model)
    {
        return $model->with($this->relations);
    }
}
