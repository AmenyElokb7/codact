<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAdNotification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        if (auth()->user()->hasRole('admin')) {
            return view('admin.index',compact('notifications'));  
        } else if(auth()->user()->hasRole('publisher')) {
            return view('publisher.index',compact('notifications'));
        } else if(auth()->user()->hasRole('subscriber')){
            return view('subscriber.index', compact('notifications'));
        }  else {
            abort(403); 
        }
    }
   
}
