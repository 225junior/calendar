<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acaronlex\LaravelCalendar\Calendar;

class CalendarController extends Controller
{
    public function index()
    {

        $events = [];

        $events[] = Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

        $events[] = Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $calendar = new Calendar();
        $calendar->addEvents($events)
        ->setOptions([
            'plugins' => [ 'window.interaction', 'window.momentPlugin', 'window.dayGridPlugin', 'window.timeGridPlugin', 'window.listPlugin' ],
            'locales' => 'window.allLocales',
            'locale' => 'fr',
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'timeGridWeek',
            'headerToolbar' => [
                'left' => 'prev,next today myCustomButton',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay'
            ],
            'customButtons' => [
                'myCustomButton' => [
                    'text'=> 'custom!',
                    'click' => 'function() {
                        alert(\'clicked the custom button!\');
                    }'
                ]
            ]
        ]);
        $calendar->setId('1');
        $calendar->setEs6();
        $calendar->setCallbacks([
            'select' => 'function(info) {
                alert(\'selected \' + info.startStr + \' to \' + info.endStr);
            }',
            'eventClick' => 'function(info) {
                alert(\'Event: \' + info.event.title);
                alert(\'Coordinates: \' + info.jsEvent.pageX + \',\' + info.jsEvent.pageY);
                alert(\'View: \' + info.view.type);

                // change the border color just for fun
                info.el.style.borderColor = \'red\';
            }',
            'dateClick' => 'function(info) {
                alert(\'clicked \' + info.dateStr);
            }'
        ]);

        // dd($calendar);
        return view('welcome', compact('calendar'));
    }

}
