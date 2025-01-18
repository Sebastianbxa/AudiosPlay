<?php

namespace App\Http\Controllers\Portal;
use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use App\Models\Audio;
use App\Models\Autor;
use App\Models\Comment;
use App\Models\Etiqueta;
use App\Models\Favorito;
use App\Models\Membresia;
use App\Models\Nuevo;
use App\Models\Publicidad;
use App\Models\Recomendado;
use App\Models\Saga;
use App\Models\Sagas_and_audiobook;
use App\Models\Top;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $recomendados = Recomendado::take(3)->get();
        $nuevos = Nuevo::all();
        $audios = Audio::latest()->take(12)->get(); 
      
        return view('portal.index')->with('audios',$audios)
        ->with('recomendados',$recomendados)
        ->with('nuevos',$nuevos);
    }

    public function todos()
    {
        $audios = Audio::latest()->paginate(12);
        $generos =Etiqueta::orderBy('genero', 'asc')->get();
        $autors = Autor::orderBy('autor', 'asc')->get();
        $years = Year::orderBy('year', 'desc')->get();

        return view('portal.todos')
        ->with('audios', $audios)
        ->with('generos', $generos)
        ->with('autors', $autors)
        ->with('years', $years);
    }


    public function top()
    {
        $tops = Top::orderBy('posicion', 'asc')->get();
        return view('portal.top')
        ->with('tops', $tops);
    }

    public function sugeridos()
    {
        $tops = Audio::orderBy('view', 'desc')->take(100)->get();
        return view('portal.sugeridos')
        ->with('tops', $tops);
    }


    public function search(Request $request)
    {

        //Filtrar
        if (isset($request->year) or isset($request->autor) or isset($request->genero)) {    
            $filters = [
                'year' => $request->year,
                'autor'    => $request->autor,
                'genero'    => $request->genero,
            ];
     
            $searchAudios = Audio::latest()->where(function ($query) use ($filters) {
                    if ($filters['year']) {
                        $query->where('year_id', '=', $filters['year']);
                    }
                    if ($filters['autor']) {
                        $query->where('autor_id', '=', $filters['autor']);
                    }
    
                    if ($filters['genero']) {
                        $query->where('genero_id', '=', $filters['genero']);
                    }
                })->paginate(12); 
            $generos =Etiqueta::orderBy('genero', 'asc')->get();
            $autors = Autor::orderBy('autor', 'asc')->get();
            $years = Year::orderBy('year', 'desc')->get();
        
            return view('portal.searchs', compact('searchAudios'))
            ->with('generos', $generos)
            ->with('autors', $autors)
            ->with('years', $years);
            
        }

       
    //Busqueda
      if ($request->search) {
       
        //Genera varios resultados
        $searchAudios = Audio::where('titulo','LIKE','%'.$request->search.'%')->paginate(12);

    
        //Si solo viene un audiolibro
        if(count($searchAudios)==1)
        {        
            
            if (Auth::check()) {

                //Buscar el audiolibro
                $id=$searchAudios[0]->id;
                $audio = Audio::where('id',$id)->first();
                

                //Contador de visitas 2.0
                $update = [
                    'view' =>$audio->view + 1,
                ];
                Audio::where('id',$audio->id)->update($update);

                
                //Saber si esta guardado
                $audiolibro_id = $id;
                $like = Favorito::where('audiolibro_id', $audiolibro_id)->where('user_id', auth()->user()->id)->first();


                //Validar Membresia
                $user_id = (auth()->user()->id); 
                $membresia = Membresia::where('user_id',$user_id)->first();
                
                if ($membresia == null) {
                    $membresia = "Desactivado";
                } else {
                    if ($membresia->status == "Activado") {
                        $membresia = "Activado"; 
                    }else{
                        $membresia = "Desactivado"; 
                   }
                }
                

                $recomendados = Recomendado::all();
                $generos =Etiqueta::orderBy('genero', 'asc')->get();
                $autors = Autor::orderBy('autor', 'asc')->get();
                $years = Year::orderBy('year', 'asc')->get();

                $comentarios = Comment::where('audiolibro_id', $audiolibro_id)->orderBy('created_at', 'desc')->get();
                $publicidad = Publicidad::all();

                return view('portal.detalles')->with('id',$id)->with('audio',$audio)
                ->with('recomendados',$recomendados)
                ->with('generos',$generos)
                ->with('autors',$autors)
                ->with('years',$years)
                ->with('like',$like)
                ->with('membresia',$membresia)
                ->with('comentarios',$comentarios)
                ->with('publicidad',$publicidad);
            }else{


                $id=$searchAudios[0]->id;
                $audio = Audio::where('id',$id)->first();
                $audiolibro_id = $id;

                
                //Contador de visitas 2.0
                $update = [
                    'view' =>$audio->view + 1,
                ];
                Audio::where('id',$audio->id)->update($update);

                $recomendados = Recomendado::all();
                $generos =Etiqueta::orderBy('genero', 'asc')->get();
                $autors = Autor::orderBy('autor', 'asc')->get();
                $years = Year::orderBy('year', 'asc')->get();


                //Validar Membresia
                $membresia = "Desactivado";
    
                $comentarios = Comment::where('audiolibro_id', $audiolibro_id)->orderBy('created_at', 'desc')->get();
                $publicidad = Publicidad::all();

                return view('portal.detalles')->with('id',$id)
                ->with('generos',$generos)
                ->with('autors',$autors)
                ->with('years',$years)
                ->with('audio',$audio)
                ->with('membresia',$membresia)
                ->with('recomendados',$recomendados)
                ->with('comentarios',$comentarios)
                ->with('publicidad',$publicidad);
            }
      
          
        }
        else
        {

            $generos =Etiqueta::orderBy('genero', 'asc')->get();
            $autors = Autor::orderBy('autor', 'asc')->get();
            $years = Year::orderBy('year', 'desc')->get();
            return view('portal.searchs', compact('searchAudios'))
            ->with('generos',$generos)
            ->with('autors',$autors)
            ->with('years',$years);
        }
      } else {
        return redirect()->back()->with('message','Empty Search');
      }
           
    }

        
    public function genero($genero)
    {    
        $etiquetas = Etiqueta::where('genero',$genero)->first();
        //Extraer id
        $genero_id = $etiquetas->id;
        $searchAudios = Audio::where('genero_id',$genero_id)->paginate(12);
        return view('portal.genero')
        ->with('searchAudios', $searchAudios);
    }


    public function autor($autor)
    {
        
        $autors = Autor::where('autor',$autor)->first();
        //Extraer id
        $autor_id = $autors->id;
        $searchAudios = Audio::where('autor_id',$autor_id)->paginate(12);
        return view('portal.autor')
        ->with('searchAudios', $searchAudios);
       
    }


    public function favoritos()
    {
        $user_id = (auth()->user()->id); 
		$favoritos = Favorito::where('user_id',$user_id)->latest()->paginate(18);
		$favoritos_total = Favorito::where('user_id',$user_id)->get();
        return view('portal.favoritos')
        ->with('favoritos', $favoritos)
        ->with('favoritos_total', $favoritos_total)
        ->with('message','Empty Search');
    }


    
    public function sagas(){
        $sagas = Saga::latest()->paginate(12);
        return view('portal.sagas')->with('sagas',$sagas);
    }
       

    public function sagas_view($saga)
    {
        $consulta = Saga::where('nombre',$saga)->first();
        //Extraer id
        $sagas_id = $consulta->id;
        $sagas_views = Sagas_and_audiobook::where('sagas_id', $sagas_id)->latest()->get();
        return view('portal.sagas_view')->with('sagas_views',$sagas_views);
    }

    
    public function membresia(){
        
        if (Auth::check()) {
            $user_id = (auth()->user()->id); 
            $membresia = Membresia::where('user_id',$user_id)->first();
            //Validar Membresia
            if ($membresia == null) {
                $membresia == "Desactivado";
                $metodosPago = Ajuste::all();
           
                return view('portal.membresia')
                ->with('membresia', $membresia)
                ->with('metodosPago', $metodosPago);
                
            }else{
                if ($membresia->status == "Activado") {
                    $membresia = "Activado"; 
                }else{
                    $membresia = "Desactivado"; 
                }
                $metodosPago = Ajuste::all();
                return view('portal.membresia')
                ->with('metodosPago', $metodosPago)
                ->with('membresia', $membresia);
                
            }
        }
        $metodosPago = Ajuste::all();
        return view('portal.membresia')->with('metodosPago', $metodosPago);
    }

   
    public function Pagos(Request $request)
    {
       
        switch ($request->input('opcion')) {
            case '1':
                return redirect('');
                break;

            case '2':
                return redirect('');
                break;

            case '3':
                return redirect('');
                break;

            case '4':
                return redirect('');
                break;
            
            default:
                # code...
                break;
        }
       

    }



    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect('/');
    }


    public function profile(){

        $user_id = Auth::user()->id;
        $favoritos = Favorito::where('user_id', $user_id)->get();
        $comentarios = Comment::where('user_id', $user_id)->get();
        return view('portal.profile')
        ->with('favoritos',$favoritos)
        ->with('comentarios',$comentarios);
    }


    public function profile_settings(){   
        return view('portal.profile_settings');
    }


    public function password_reset(Request $request)
    {        
        $user = Auth::user();
        $user->password = Hash::make($request->nuevaContraseña);
        $user->save();
        return back()->with('mensaje', 'ok');
    }


    
    public function info_reset(Request $request)
    {

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->pais = $request->pais;
        $user->save();
        return back()->with('mensaje', 'ok');
    }

    public function terminos(){   
        return view('portal.terminos');
    }


    public function politica_y_privacidad(){   
        return view('portal.politica_y_privacidad');
    }

    public function dmca(){   
        return view('portal.dmca');
    }


    public function documentation(){   
        return view('documentation.introduction');
    }

    public function documentation_install(){   
        return view('documentation.install');
    }




}
