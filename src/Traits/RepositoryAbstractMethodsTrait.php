<?php

namespace WesMurray\Repositories\Traits;

trait RepositoryAbstractMethodsTrait
{
    /**
     * @return array $collection
     */
    public function get()
    {
        return $this->model->get();
    }
    
    /**
     * @param array $data
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }
    
    /**
     * @param int $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        return $this->model->update($id, $data);
    }
    
    /**
     * @param int $id
     */
    public function delete($id)
    {
        return $this->model->delete($id);
    }
    
    /**
     * @param int $id
     */
    public function forceDelete($id)
    {
        return $this->model->forceDelete($id);
    }
    
    /**
     * @param int $count
     */
    public function paginate($count)
    {
        return $this->model->paginate($count);
    }
    
    /**
     * @param int $id
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * @param string $login
     */
    public function findByLogin($login)
    {
        return $this->model->where('login', $login)->firstOrFail();
    }
    
    /**
     * @param string $slug
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }
}
