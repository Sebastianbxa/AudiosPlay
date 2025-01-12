<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;


use App\Models\Autor;
use App\Models\Calificacion;
use App\Models\Etiqueta;
use App\Models\Year;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     
        if ($request->input('genero') > 0){
            $etiquetas = new Etiqueta();
            $etiquetas->genero = $request->input('genero');
            $etiquetas->save();
        }


        if ($request->input('autor') > 0){
            $autors = new Autor();
            $autors->autor = $request->input('autor');
            $autors->save();
        }


        if ($request->input('year') > 0){
            $years = new Year();
            $years->year = $request->input('year');
            $years->save();

        }

        if ($request->input('calificacion') > 0){
            
        $calificacions = new Calificacion();
        $calificacions->calificacion = $request->input('calificacion');
        $calificacions->save();
        }
       
        return back()->with('mensaje', 'ok'); 
    }


    public function edit_autor($id)
    {
        
        $autor = Autor::where('id',$id)->first();
	    return view('panel.edit_autor')->with('autor', $autor);
    }

   
    public function update_autor(Request $request, $id)
    {
        $autor = Autor::find($id);
        $autor->update([
            "autor" => $request["autor"]
        ]);
		return redirect('panel/etiqueta/admin')->with('eliminar', 'ok');
    }


    public function edit_genero($id)
    {
        $etiqueta = Etiqueta::where('id',$id)->first();
	    return view('panel.edit_genero')->with('etiqueta', $etiqueta);
    }


    public function update_genero(Request $request, $id)
    {
        $etiqueta = Etiqueta::find($id);
        $etiqueta->update([
            "genero" => $request["genero"]
        ]);
		return redirect('panel/etiqueta/admin')->with('mensaje', 'ok');
    }



    public function edit_year($id)
    { 
        $year = Year::where('id',$id)->first();
	    return view('panel.edit_year')->with('year', $year);
    }

   
    public function update_year(Request $request, $id)
    {
        $year = Year::find($id);
        $year->update([
            "year" => $request["year"]
        ]);
		return redirect('panel/etiqueta/admin')->with('mensaje', 'ok');
    }



    public function edit_calificacion($id)
    {
        $calificacion = Calificacion::where('id',$id)->first();
	    return view('panel.edit_calificacion')->with('calificacion', $calificacion);
    }

    
    public function update_calificacion(Request $request, $id)
    {
        $calificacion = Calificacion::find($id);   
        $calificacion->update([
            "calificacion" => $request["calificacion"]
        ]);
        return redirect('panel/etiqueta/admin')->with('mensaje', 'ok');
    }


  
    public function etiqueta()
    {
        $etiquetas = Etiqueta::orderBy('genero', 'asc')->get();
        $autors = Autor::orderBy('autor', 'asc')->get();
        $years = Year::orderBy('year', 'asc')->get();
        $calificacions = Calificacion::orderBy('calificacion', 'asc')->get();

        return view('panel.etiqueta')
        ->with('etiquetas',$etiquetas)
        ->with('years',$years)
        ->with('autors',$autors)
        ->with('calificacions',$calificacions);
    }

}
