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
     * @param int $uuid
     * @param array $data
     */
    public function update($uuid, array $data)
    {
        return $this->model->update($id, $data);
    }
    
    /**
     * @param int $id
     */
    public function delete($uuid)
    {
        return $this->model->whereUuid($uuid)->delete();
    }
    
    /**
     * @param int $id
     */
    public function forceDelete($uuid)
    {
        return $this->model->whereUuid($uuid)->forceDelete();
    }
    
    /**
     * @param int $count
     */
    public function paginate($count)
    {
        return $this->model->paginate($count);
    }
    
    /**
     * @param int $uuid
     */
    public function findById($uuid)
    {
        return $this->model->whereUuid($uuid)->firstOrFail();
    }
    
    /**
     * @param int $id
     */
    public function findById($id)
    {
        return $this->model->firstOrFail($id);
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
