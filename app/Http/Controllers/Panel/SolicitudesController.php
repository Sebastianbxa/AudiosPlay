<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use App\Models\Peticione;
use App\Models\Reporte;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    public function peticiones()
    {
        $peticiones = Peticione::latest()->get();
        return view('panel.peticione')->with('peticiones', $peticiones);  
    }


    public function destroy_peticiones($id)
    {
        $peticione = Peticione::where('id',$id)->first();
        $peticione->delete();
        return back();
    }


    public function peticiones_destroy_all()
    {
        Peticione::query()->delete();
        return back();
    }




    public function reportes()
    {
        $reportes = Reporte::latest()->get();
        return view('panel.reporte')->with('reportes',$reportes);   
    }

    public function destroyReportes($id)
    {
        $reporte = Reporte::where('id',$id)->first();
        $reporte->delete();
        return back();
    }

    
    public function reporte_destroy_all()
    {
        Reporte::query()->delete();
        return back();
    }

    public function contacto()
    {
        $contactos = Contacto::latest()->get();
        return view('panel.contacto')->with('contactos',$contactos);   
        
    }


    public function destroy_contacto($id)
    {
        $contacto = Contacto::where('id',$id)->first();
        $contacto->delete();
        return back();
    }


    public function contacto_destroy_all()
    {
       
        Contacto::query()->delete();
        return back();
    }



}
