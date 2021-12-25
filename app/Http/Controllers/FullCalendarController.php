<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {

            $data = Events::whereDate('start','>=', $request->start)
                    ->whereDate('end','<=', $request->end)
                    ->get();

            return response()->json($data);
        }
        return view('welcome');
    }


    public function action(Request $request){

        if ($request->ajax()){
            if ($request->type == "add") {
                $event = Events::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
            }
        }
    }
}
