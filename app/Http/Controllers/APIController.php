<?php

namespace App\Http\Controllers;

use App\Reporsitories\TicketsReporsitory;
use App\Reporsitories\UserReporsitory;
use App\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class APIController extends Controller
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
        $tickets = $this->ticketrep->getAll();

        return Response()->json([
            'tickets'=> $tickets
        ]);

    }

    public function store(Request $request)
    {
        if($this->userrepo->User_Exists($request->input('user_id'))) {
            $data =[
                'title'=> $request->input('title'),
                'content' =>$request->input('content'),
                'created_at' => date('d.m.y h:m.s') ,
                'updated_at' => date('d.m.y h:m.s'),
                'user_id' => $request->input('user_id') ,
            ];


        $ticket = $this->ticketrep->create($data);

        return Response()->json([
            'message' => 'ticket added succussufuly '
        ]
        ,200);

       }else {
            return Response()->json([
                'error' => 'ticket Failed '
            ]
            ,422);

        }

    }
    public function update(Request $request, $id)
    {
        if(Ticket::where('id',$id)->exists()) {

            $ticket = $this->ticketrep->find($id);

            $ticket->title =  is_null($request->input('title'))? $ticket->title:$request->input('title');

            $ticket->content = is_null($request->input('content'))? $ticket->content:$request->input('content');

            $ticket->save();

            return Response()->json([
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
        $ticket = $this->ticketrep->find($id);

        if($ticket) {

            $ticket->delete();

            return response()->json([
                'message' => 'ticket with the id '.$id.' is deleted succussfuly'
            ],202);
        } else {
            return response()->json([
                'error' => 'no id for this ticket'
            ],400);

        }
    }


}
