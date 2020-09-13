<?php

namespace App\Reporsitories;

use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{

    /**
    * @return Model
    */
    public function all():array;

   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param $id
    * @return Model
    */
    public function update(array $data,int $id): ?Model;

    /**
    * @param $id
    * @return Model
    */
    public function delete($id): ?Model;




}
