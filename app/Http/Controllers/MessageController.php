<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = \App\Models\Conversation::all();
        return view('single-pages.messages' , compact('conversations'));
    }
}
