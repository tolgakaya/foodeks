<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use Redirect, Response;
use App\User;
use App\Restaurant;

class FullCalendarController extends Controller
{
    public function index()
    {
        // if (request()->ajax()) {

        //     // $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
        //     // $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

        //     // $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id', 'title', 'start', 'end']);
        //     // return Response::json($data);
        // }
        // $users = User::all();
        // //restaurantsı gönderme konusunda emin değilim
        // $restaurants = Restaurant::all();
        // return view('backend.bookings.calendar', compact('restaurants'));
    }


    public function create(Request $request)
    {
        $insertArr = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Event::insert($insertArr);
        return Response::json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();

        return Response::json($event);
    }
}