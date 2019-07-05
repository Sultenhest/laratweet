<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Status $status)
    {
        $status->like();

        return redirect($status->path());
    }

    public function destroy(Status $status)
    {
        $status->unlike();

        return redirect($status->path());
    }
}
