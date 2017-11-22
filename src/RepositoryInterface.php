<?php

namespace WesMurray\Repositories;

interface RepositoryInterface
{
    /**
     * Returns a collection of the
     * model instance
     *
     * @return array $collection
     */
    public function get();
}
