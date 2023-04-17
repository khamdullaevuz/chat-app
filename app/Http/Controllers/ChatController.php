<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use WebSocket\Client;

class ChatController extends Controller
{
    public function __invoke(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $name = $request->get('name');

        return view('chat', compact('name'));
    }
}
