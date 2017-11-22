<?php 

namespace WesMurray\Repositories\Traits\Criteria;

trait CriteriaTrait
{
    /**
     * Handle a request to resolve the repository
     * criteria.
     *
     * @param arrray $criteria
     */
    public function withCriteria(...$criteria)
    {
        $criteria = array_flatten($criteria);
        
        foreach ($criteria as $criterion) {
            $this->model = $criterion->apply($this->model);
        }
        
        return $this;
    }
}
