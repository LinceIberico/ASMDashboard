<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(){
        // $clients = Client::all();

        return view('panel.clients.clients');
    }
}
