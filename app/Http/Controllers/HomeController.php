<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activities = Activity::feed(
            auth()->user()->following->pluck('id')->push(auth()->id())
        );

        $users = User::take(15)->get();

        return view('home', compact('activities', 'users'));
    }
}
