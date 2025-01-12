<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use App\Models\Membresia;
use App\Models\User;
use Illuminate\Http\Request;

class MembresiaController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:admin.index')->only('index','destroy','update','create');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::latest()->get(); 
        $membresias = Membresia::all();

        return view('panel.membresia')
        ->with('membresias',$membresias)
        ->with('usuarios',$usuarios);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $membresia = new Membresia();
        $membresia->user_id = $request->input('user_id');
        $membresia->status = $request->input('status');
        $membresia->save();
        return back();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $membresia = Membresia::find($id);
        $membresia->update([
            "status" => $request["status"]
        ]);
		return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membresia = Membresia::where('id',$id)->first();
        $membresia->delete();
        return back();
    }
}
