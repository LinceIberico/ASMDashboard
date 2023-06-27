<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

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
        
        $comprobar_user = User::where('email', $request->email)->first();
        
        if($comprobar_user == null){
            
            $user = User::create([
                'name'=>$request->name,
                'email' => $request->email,
                'password' => $request->password_2
            ]);
            
            $user->save();

            $user->assignRole($request->rol);

            $message = "Usuario ".$request->name." con email ".$request->email." ha sido creado con éxito.";
            return redirect()->route('user.create')->with('success', strtoupper($message));
            
        }else{
            $message = "El usuario ".$request->name." con email ".$request->email." ya existe en la base de datos.";
            return redirect()->route('user.create')->with('error', strtoupper($message));
        }

        // try{
            // $request->validate([
            //     'name' => 'required|min:3',
            //     'email' => 'required|unique:email',
            //     'password_1' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            //     'password_2' => 'required|same:password_1',
            // ]);
            
        //     $user = User::create([
        //         'name'=>$request->name,
        //         'email' => $request->email,
        //         'password' => $request->password_2
        //     ]);
        //     $user->save();

        //     // $user = User::find(1);
        //     $user->assignRole($request->rol);
        
        //     return redirect()->route('user.create')->with('success', "Usuario creado con éxito");

        // }catch(Exception $e){
        //     $message = $e->getMessage();
        //     return redirect()->route('user.create')->with('error', $message);
        // }


    }

    public function edit(User $user){

        $roles = DB::table('roles')->select('id', 'name')->get();
        // $roles = Role::pluck('name');

        $selected = $user->getRoleNames();

        $arrayRoles = array();
        foreach($selected as $clave => $valor){
            $array = array(
                'name'=> $valor
            );
            array_push($arrayRoles,$array);
        }
        
        $arraySelect = json_decode($selected);
        // dd($selected,$roles, $arraySelect, $arrayRoles);
        
        return view('panel.users.edit-user', compact('user','roles','selected','arraySelect'));
    }

    public function update(Request $request){

        $roles = DB::table('roles')->select('id', 'name')->get();

        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);

        return redirect()->route('user.index');
    }

    public function delete(User $user){

        if(isset($user->id)){
            $user->delete();
            $message = "Usuario ".$user->name." con email ".$user->email." ha sido eliminado con éxito.";
            return redirect()->route('user.index')->with('success', strtoupper($message));
        }else{
            $message = "El usuario ".$user->name." con email ".$user->email." no se pudo eliminar.";
            return redirect()->route('user.index')->with('warning', strtoupper($message));
        }
    }

    public function forceDelete(){

    }

    public function restore($id){
        
        if(isset($id)){
            $user = User::onlyTrashed()->findOrFail($id);
            $user->restore();
            $message = "Usuario ".$user->name." con email ".$user->email." ha sido restaurado con éxito.";
            return redirect()->route('user.index')->with('success', strtoupper($message));
        }else{
            $message = "El usuario ".$user->name." con email ".$user->email." no se pudo restaurar.";
            return redirect()->route('user.index')->with('warning', strtoupper($message));
        }

    }

    public function show(){

    }
}
