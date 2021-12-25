<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarLocalController extends Controller
{
    public function index(Request $request){

        return view('calendar');
    }
}
