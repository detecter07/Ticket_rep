<?php

namespace App\Http\Controllers;

use App\Reporsitories\TicketsReporsitory;
use App\Reporsitories\UserReporsitory;
use App\Ticket;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class APIUserController extends Controller
{
    private $ticketrep;
    private $userrepo;

    public function __construct(TicketsReporsitory $ticketrep,UserReporsitory $userrepo)
    {
        $this->ticketrep = $ticketrep;
        $this->userrepo = $userrepo;


    }
    public function index()
    {
        $users = User::onlyTrashed()->get();

        if ($users === [])
        {

            return response()->json([
                'message' => 'table users is empty '
            ],400);
        }else {
            return Response()->json([
                'users'=> $users,
        ],200);

        }





    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        if(!$validatedData) {

            return response()->json([
                "erro" => "user can not be Empty"
            ], 404);
        }else {
            $data =[
                'name'=> $request->input('name')
            ];

        $user = $this->userrepo->create($data);

        return response()->json([
            'message' => 'user added succussufuly '
        ]
        ,200);

        }

    }
    public function update(Request $request, $id)
    {
        if(Ticket::where('id',$id)->exists()) {

            $ticket = $this->ticketrep->find($id);

            $ticket->title =  is_null($request->input('title'))? $ticket->title:$request->input('title');

            $ticket->content = is_null($request->input('content'))? $ticket->content:$request->input('content');

            $ticket->save();

            return response()->json([
                "message" => "records updated successfully"
                ],200);

        } else {
            return response()->json([
                "message" => "Ticket not found"
            ], 404);
        }

    }
    public function show(int $id)
    {
        $ticket = $this->ticketrep->find($id);

        if($ticket) {
            return response()->json([
                'Ticket' =>$ticket
            ],200);

        } else {
            return response()->json([
                'message' =>'ticket not found'
            ],422 );
        }
    }

    public function delete(int $id)
    {
        $user = $this->userrepo->find($id);

        if($user) {

            $user->delete();

            return response()->json([
                'message' => 'user with the id '.$id.' is deleted succussfuly'
            ],202);
        } else {
            return response()->json([
                'error' => 'no id for this ticket'
            ],400);

        }
    }


}
