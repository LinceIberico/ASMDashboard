<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        // $users = User::all();

        return view('panel.users.users');
    }

    public function create(){

        return view('panel.users.new-user');
    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }

    public function forceDelete(){

    }

    public function show(){

    }
}
