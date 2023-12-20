<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        return view('single-pages.testpusher');
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->message))->toOthers();
        return view('single-pages.testbroadcast', ['message' => $request->message]);
    }

    public function receive(Request $request)
    {
        return view('single-pages.testreceive', ['message' => $request->message]);
    }
}
