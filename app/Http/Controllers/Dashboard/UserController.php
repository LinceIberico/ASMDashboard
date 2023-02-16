<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        // $users = User::all();

        return view('panel.users.users');
    }

    public function create(){

        try{
            $roles = DB::table('roles')->select('id', 'name')->get();

        }catch(Exception $e){
            $message = $e->getMessage();
            return $message;
        }

        // dd($roles);
        return view('panel.users.new-user', compact('roles'));
    }

    public function store(Request $request){

        try{
            // $request->validate([
            //     'name' => 'required|min:3',
            //     'email' => 'required|unique|email',
            //     'password_1' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            //     'password_2' => 'required|same:password_1',
            // ]);

            $user = $request->all();
        
            return redirect()->route('user.create')->with('success', "Usuario creado con éxito");

        }catch(Exception $e){
            $message = $e->getMessage();
            return redirect()->route('user.create')->with('error', $message);
        }


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
