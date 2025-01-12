<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use App\Models\Audio;
use App\Models\Nuevo;
use App\Models\Recomendado;
use Illuminate\Http\Request;

class RecomendadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audios = Audio::orderBy('titulo', 'asc')->get();
        $recomendados = Recomendado::all();
        $nuevos = Nuevo::all();

        return view('panel.clasificado')
        ->with('audios', $audios)
        ->with('nuevos', $nuevos)
        ->with('recomendados', $recomendados);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->input('recomendado')) {
            $recomendados = new Recomendado();
            $recomendados->recomendado_id = $request->input('recomendado');
            $recomendados->save();
        }
        
        

        if ($request->input('nuevo')) {
            $nuevos = new Nuevo();
            $nuevos->nuevo_id = $request->input('nuevo');
            $nuevos->save();           
        }
       

        return back()->with('mensaje', 'ok'); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recomendado  $recomendado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $recomendado = Recomendado::where('id',$id)->first();
        $recomendado->delete();
        return back();
    }

    public function destroy_nuevo($id)
    {
        
        $nuevo = Nuevo::where('id',$id)->first();
        $nuevo->delete();
        return back();
    }


}
