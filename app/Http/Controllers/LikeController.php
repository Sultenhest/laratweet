<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Status $status)
    {
        $status->like();

        return redirect($status->path());
    }

    public function unlike(Status $status)
    {
        $status->unlike();

        return redirect($status->path());
    }
}
