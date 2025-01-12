<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use App\Models\Audio;
use App\Models\Autor;
use App\Models\Calificacion;
use App\Models\Etiqueta;
use App\Models\Peticione;
use App\Models\Reporte;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{



    public function __construct()
    {
        $this->middleware('can:admin.index')->only('index','peticiones','reportes','destroyReportes','destroyReportes','destroy_contacto');
        $this->middleware('can:admin.create')->only('create','destroy');
        $this->middleware('can:admin.create.colaborador')->only('colaborador');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audios = Audio::latest()->get(); 
        return view('panel.index')
        ->with('audios',$audios);
    }


            
    public function dashboard()
    {
        $usuarios = User::all();
        $audios = Audio::all();
        $status = null;
        $peticiones = Peticione::where('status', $status)->get();
        $reportes = Reporte::all();
      

        //Redirecciona el admin y el colaborados a distintas paginas
         $rol_admin = User::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
         $user_id = (auth()->user()->id); 
         
         foreach ($rol_admin as $rol) {
             if ($rol->id == $user_id) {
                 $autenticacion = 1;
             }
         }
         if (isset($rol_admin) && isset($autenticacion)) {
            return view('panel.dashboard')
            ->with('usuarios',$usuarios)
            ->with('audios',$audios)
            ->with('peticiones',$peticiones)
            ->with('reportes',$reportes);
         }else{
            return redirect('/panel/create');
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etiquetas = Etiqueta::orderBy('genero', 'asc')->get();
        $autors = Autor::orderBy('autor', 'asc')->get();
        $years = Year::orderBy('year', 'asc')->get();
        $calificacions = Calificacion::orderBy('calificacion', 'asc')->get();

        return view('panel.create')
        ->with('etiquetas',$etiquetas)
        ->with('autors',$autors)
        ->with('years',$years)
        ->with('calificacions',$calificacions);
        

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $audios = new Audio();
        $audios->titulo = $request->input('titulo');
        $audios->descripcion = $request->input('descripcion');
                
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPatch = 'images/poster/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSucces = $request->file('imagen')->move($destinationPatch, $filename);
            $audios->imagen = $destinationPatch . $filename;
        }

        $audios->genero_id = $request->input('genero');
        $audios->autor_id = $request->input('autor');
        $audios->year_id = $request->input('year');
        $audios->time = $request->input('time');
        $audios->calificacion_id = $request->input('calificacion');
        $audios->url_a = $request->input('url_a');
        $audios->url_b = $request->input('url_b');
        $audios->url_c = $request->input('url_c');
        $audios->download_free = $request->input('download_free');
        $audios->download_1 = $request->input('download_1');
        $audios->download_2 = $request->input('download_2');


        $user_id = (auth()->user()->id); 
        $audios->user_id = $user_id; 

        $audios->save();
        return redirect('/panel/create')->with('mensaje', 'ok'); 


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etiquetas = Etiqueta::all();
        $autors = Autor::all();
        $years = Year::all();
        $calificacions = Calificacion::all();

        $audio = Audio::where('id',$id)->first();

	    return view('panel.edit')->with('audio', $audio)
        ->with('etiquetas',$etiquetas)
        ->with('autors',$autors)
        ->with('years',$years)
        ->with('calificacions',$calificacions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $audio = Audio::find($id);
       
        $audio->update([
            "titulo" => $request["titulo"],
            "descripcion" => $request["descripcion"],
            "genero_id" => $request["genero"],
            "autor_id" => $request["autor"],
            "year_id" => $request["year"],
            "calificacion_id" => $request["calificacion"],
            "time" => $request["time"],
            "url_a" => $request["url_a"],
            "url_b" => $request["url_b"],
            "url_c" => $request["url_c"],
            "download_free" => $request["download_free"],
            "download_1" => $request["download_1"],
            "download_2" => $request["download_2"]
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPatch = 'images/poster/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSucces = $request->file('imagen')->move($destinationPatch, $filename);
            $audio->imagen = $destinationPatch . $filename;
            $audio->save();
        }


        //Redirecciona el admin y el colaborados a distintas paginas
        $rol_admin = User::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
        $user_id = (auth()->user()->id); 
        
        foreach ($rol_admin as $rol) {
            if ($rol->id == $user_id) {
                $autenticacion = 1;
            }
        }
        if (isset($rol_admin) && isset($autenticacion)) {
            return redirect('/panel')->with('mensaje', 'ok');
        }else{
            return redirect('/panel/publicaciones/todas')->with('mensaje', 'ok');
        }
       
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$audio = Audio::find($id);
        $audio = Audio::where('id',$id)->first();
        $audio->delete();
        return redirect('/panel/publicaciones/todas');
    }


    
    public function colaborador($user_id)
    {
     
        $user_id = (auth()->user()->id); 
        $audios = Audio::where('user_id',$user_id)->latest()->get();
        return view('panel.colaborador')
        ->with('user_id',$user_id)
        ->with('audios',$audios);
    }







    
}
