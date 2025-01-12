<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Illuminate\Http\Request;

class PublicidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicidad = Publicidad::all();
        return view('panel.publicidad')->with('publicidad', $publicidad);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $audios = new Publicidad();
        $audios->codigo = $request->input('codigo');      
        $audios->link = $request->input('link');      
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPatch = 'images/publicidad/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSucces = $request->file('imagen')->move($destinationPatch, $filename);
            $audios->imagen = $destinationPatch . $filename;
        }

       
        $audios->save();
        return redirect('/panel/publicidad/admin')->with('eliminar', 'ok'); //se envia eliminar a sweetalert

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicidad = Publicidad::where('id',$id)->first();
        $publicidad->delete();
        return back();
    }

   
}
