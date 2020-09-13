<?php

namespace App\Reporsitories;


use App\Reporsitories\EloquentRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class UserReporsitory extends BaseReporsitory
{

    private $model;

    /**
     * Class constructor.
     */
    public function __construct(User $model)
    {
        $this->model = $model;

    }

    public function all() : array
    {
        return $this->model->all()->toArray();

    }

   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model
   {
       return $this->model->create($attributes);

   }

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model
   {
       return $this->model->find($id);

   }

   /**
    * @param $id
    * @return Model
    */
    public function update(array $data,int $id): ?Model
    {
        return $this->model->find($id)::update($data);

    }

    /**
    * @param $id
    * @return Model
    */
    public function delete($id): ?Model
    {
        return $this->model->find($id)::delete();

    }

    public function User_Exists(int $id) :bool
    {
        $user = $this->model->find($id);

        if($user) {
            return True;
        } else {
            return false;
        }

    }
}
