<?php

namespace App\Http\Controllers;

use App\User;

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
        $statuses = DB::table('follows')
            ->join('statuses', 'follows.followed_user_id', '=', 'statuses.user_id')
            ->join('users', 'statuses.user_id', '=', 'users.id')
            ->select('statuses.*', 'users.username', 'users.name')
            ->where('follows.follower_user_id', '=', auth()->id())
            ->latest()
            ->limit(15)
            ->get()
            ->toArray();

        $users = User::take(15)->get();

        return view('home', compact('statuses', 'users'));
    }
}
