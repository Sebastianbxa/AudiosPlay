<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

//use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;
use Laravel\Fortify\Rules\Password;




class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.users')->only('index','create', 'update', 'edit', 'destroy', 'store', 'show');

    }
    /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function index()
    {   
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index')->with('users' ,$users);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
    public function store(Request $request)
    {
        $users = new User();

        $users->name = $request->get('name');
        $users->email = $request->get('email');
        //$users->Hash::make(＄request->('password'));
        //$users->password = $request->bcrypt('password');
        //$users->password = Hash::make($users->password);
        $users->password = (new Password)->length(10);
        

        $users->save();
        return redirect('/users');
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function show($id)
    {
        //
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->update([
            "name" => $request["name"],
            "status" => $request["status"]
        ]);

        return redirect()->route('admin.users.edit', $user)->with('info', 'Actualizado Correctamente');
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index', $user)->with('info', 'El usuario se elimino con éxito');
    }
}



