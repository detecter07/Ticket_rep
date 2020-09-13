<?php

namespace App\Reporsitories;


use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;
use App\Reporsitories\EloquentRepositoryInterface;

class TicketsReporsitory extends BaseReporsitory
{

    private $model;

    /**
     * Class constructor.
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;

    }

    public function all() : array
    {
        return $this->model->all()->toArray();

    }

    public function getAll()
    {
        $ticket = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
       ->select('users.name','tickets.title','tickets.content','users.id','tickets.created_at')
       ->get()
       ->toArray();


        return $ticket;
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
}
