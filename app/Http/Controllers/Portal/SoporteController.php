<?php

namespace App\Http\Controllers\Portal;
use App\Http\Controllers\Controller;

use App\Models\Contacto;
use App\Models\Peticione;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoporteController extends Controller
{
    public function storeReporte(Request $request, $id)
    {
        
        $reportes = new Reporte();
        if (Auth::check()){
            $reportes->correo = (auth()->user()->email);
        }else{
            $reportes->correo = $request->input('correo');
        }
        $reportes->problema = $request->input('problema');
       
        $reportes->audiolibro_id = $id;
        $reportes->save();
        return redirect()->back()->with('mensaje', 'ok');

    }

   
    public function peticiones()
    {
        return view('portal.peticiones');
    }

    public function storePeticione(Request $request)
    {
        $peticiones = new Peticione();
        $peticiones->titulo = $request->input('titulo');
        $peticiones->autor = $request->input('autor');
        if (Auth::check()){
            $peticiones->correo = (auth()->user()->email);
            $peticiones->user_id = (auth()->user()->id);
        }else{
            $peticiones->correo = $request->input('correo');
        }
       
      
        $peticiones->save();
        return redirect()->back()->with('mensaje', 'ok');
    }

    public function RealizadoPeticione($id){
        $peticion = Peticione::find($id);
        $realizado = 1;
        $peticion->update([
            "status" => $realizado
        ]);
        return redirect()->back();
    }


    public function contacto(){
        return view('portal.contacto');
    }


    public function storeContacto(Request $request)
    {
        $contactos = new Contacto();
        if (Auth::check()){
            $contactos->nombre = (auth()->user()->name);
            $contactos->correo = (auth()->user()->email);
            $contactos->descripcion = $request->input('descripcion');
        }else{
            $contactos->nombre = $request->input('nombre');
            $contactos->correo = $request->input('correo');
            $contactos->descripcion = $request->input('descripcion'); 
        }
        $contactos->save();
        return redirect()->back()->with('mensaje', 'ok');
    }



}
