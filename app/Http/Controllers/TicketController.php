<?php

namespace App\Http\Controllers;

use App\Reporsitories\TicketsReporsitory;
use App\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class TicketController extends Controller
{
    private $ticketrep;

    public function __construct(TicketsReporsitory $ticketrep)
    {
        $this->ticketrep = $ticketrep;


    }
    public function index()
    {
        $tickets = $this->ticketrep->getAll();

        var_dump($tickets);
        die();

        return View('tickets.all',[
            'tickets'=> $tickets
        ]);

    }

    public function create()
    {
        return View('tickets.create');
    }
    public function add(Request $request)
    {
        $data =[
            'title'=>$request->get('title'),
            'content' =>$request->get('content'),
            'user_id' => 1
        ];

        $this->ticketrep->create($data);
        return redirect('/tickets')->with('success', 'Contact saved!');
    }
    public function show(int $id)
    {
        return view('tickets.show',[
            'ticket'=> $this->ticketrep->find($id)

        ]);
    }

    public function edit(int $id)
    {
        return view('tickets.edit',[
            'ticket' => $this->ticketrep->find($id)
        ]);
    }
    public function update(Request $request, $id)
    {
            $validator =  Validator::make($request->all(), [
                'title'=>'required',
                'content' =>'required'
            ]);

            if ($validator->fails()) {
                return redirect('tickets/create')
                            ->withErrors($validator)
                            ->withInput();
            }else {

                $ticket = $this->ticketrep->find($id);

                $ticket->title =  $request->get('title');

                $ticket->content = $request->get('content');

                $ticket->save();

                return redirect('/tickets')->with('success', 'Ticket updated successfully');


            }

    }
}
