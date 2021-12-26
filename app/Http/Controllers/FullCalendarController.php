<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    /**
     * Liste des evenements
     *
     * @param Request $request
     *
     * @return View | Json
     */
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Events::whereDate('start','>=', $request->start)
                    ->whereDate('end','<=', $request->end)
                    ->get(['id','title','start','end']);

            return response()->json($data);
        }
        return view('welcome');
    }


    /**
     * @param Request $request
     *
     * @return [type]
     */
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

            if ($request->type == "update") {
                $event = Events::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
            }
        }
    }


    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function delete(Request $request){
            $event = Events::find($request->id)->delete();

            return response()->json($event);
    }
}
