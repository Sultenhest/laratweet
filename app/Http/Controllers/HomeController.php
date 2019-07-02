<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statuses = auth()->user()->following()->with('statuses')->orderBy('created_at', 'desc')->paginate(15);
        
        $users = User::take(15)->get();

        return view('home', compact('statuses', 'users'));
    }
}
