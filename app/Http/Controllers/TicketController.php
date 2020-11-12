<?php

namespace App\Http\Controllers;

use App\Reporsitories\TicketsReporsitory;
use App\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


/*
* Ticket Controller
*/

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

        return View('tickets.all',[
            'tickets'=> $tickets
        ]);

    }

    /*
    * this method is to show our form to create a ticket
    */
    public function create()
    {
        return View('tickets.create');
    }
    
    /* store a  ticket 
   * @param Request 
    * @ return our response with success message to the view
    */ 
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
    
    /*
    * @param $id 
    * @return a single Ticket to the view
    */
    public function show(int $id)
    {
        return view('tickets.show',[
            'ticket'=> $this->ticketrep->find($id)
        ]);
    }
     /*
     * edit a ticket
    * @param $id 
    * @return a single Ticket in edit form
    */

    public function edit(int $id)
    {
        return view('tickets.edit',[
            'ticket' => $this->ticketrep->find($id)
        ]);
    }
    
    /*
    * update a ticket
    * @param $request
    * @param $id
    */
    public function update(Request $request,int $id)
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
