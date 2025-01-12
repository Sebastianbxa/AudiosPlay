<?php

namespace App\Http\Controllers\Portal;
use App\Http\Controllers\Controller;

use App\Models\Audio;
use App\Models\Comment;
use App\Models\Favorito;
use App\Models\Membresia;
use App\Models\Publicidad;
use App\Models\Recomendado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AudiolibroController extends Controller
{
    public function detalles($slug)
    {
        
        $audio = Audio::where('slug',$slug)->first();
        // $audio = Audio::findOrFail($slug);
        if ($audio == null) {
            return response()->view('errors.404', [], 404);
        }

        $recomendados = Recomendado::take(3)->get();
        if (Auth::check()) {

            //Saber si esta guardado
            $audiolibro_id = $audio->id;
            $like = Favorito::where('audiolibro_id', $audiolibro_id)->where('user_id', auth()->user()->id)->first();

             //Contador de visitas 2.0
             $update = [
                'view' =>$audio->view + 1,
            ];
            Audio::where('id',$audio->id)->update($update);

            $comentarios = Comment::where('audiolibro_id', $audiolibro_id)->orderBy('created_at', 'desc')->get();
            $publicidad = Publicidad::all();

            //Validar membresia
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
        
            return view('portal.detalles')
            ->with('audio',$audio)
            ->with('like',$like)
            ->with('comentarios',$comentarios)
            ->with('recomendados',$recomendados)
            ->with('membresia',$membresia)
            ->with('publicidad',$publicidad);
        }else{

             //Contador de visitas 2.0
             $update = [
                'view' =>$audio->view + 1,
            ];
            Audio::where('id',$audio->id)->update($update);

            $audiolibro_id = $audio->id;
            $comentarios = Comment::where('audiolibro_id', $audiolibro_id)->orderBy('created_at', 'desc')->get();

            $publicidad = Publicidad::all();
            $membresia = "Desactivada";

            return view('portal.detalles')
            ->with('audio',$audio)
            ->with('comentarios',$comentarios)
            ->with('recomendados',$recomendados)
            ->with('membresia',$membresia)
            ->with('publicidad',$publicidad);
        }       
    }


    
    public function enlaces($audio){   
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            //Validar Membremsia
            $membresia_activa = Membresia::where('user_id', $user_id)->first();

            if ($membresia_activa != null) {
                if ($membresia_activa->status == "Activado") {
                    $slug = $audio;
                    $audio = Audio::where('slug', $slug)->first();
                    return view('portal.enlaces')->with('audio', $audio);
                }
                return redirect('/membresia');
            }else{
                return redirect('/membresia');
            }
        } else {
            return redirect('/membresia');
        }   
    }


    
    public function storeComment(Request $request)
    {
        $comentario = new Comment();
        $comentario->comentario = $request->comentario;
        $comentario->user_id = $request->user_id;
        $comentario->audiolibro_id = $request->audio_id;
        $comentario->save();
    }

    public function destroy_comment($id)
    {
       
        Comment::where('id',$id)->delete();
        return response()->json(['result' => 'Borrado']);
    }


    public function view_comentario(Request $request){
    
    $audiolibro_id = $request->audio_id;
    
        $comentario_nuevo = $request->validar;
        if ($comentario_nuevo) {
            $comentario_nuevo = Comment::with('usuarios')
            ->where('audiolibro_id', $audiolibro_id)
            ->orderBy('created_at', 'desc')
            ->latest()
            ->take(1)
            ->get();

            return response()->json(['comentario_nuevo' => $comentario_nuevo]);
        } else {
            $comentarios = Comment::with('usuarios')
            ->where('audiolibro_id', $audiolibro_id)
            ->orderBy('created_at', 'desc')
            ->get();
            return response()->json(['comentarios' => $comentarios]);
        }


    }



    
    public function favoritos_view(Request $request)
    { 
        $user_id = Auth::user()->id;
        $audiolibro_id = $request->id;    
        $favorito_view = Favorito::where('audiolibro_id', $audiolibro_id)->where('user_id', $user_id)->get();
            return response()->json(['favorito_view' => $favorito_view]);
    }


    public function favoritos_store(Request $request){
       
        $audiolibro_id = $request->id;
        
        $like = Favorito::where('audiolibro_id', $audiolibro_id)->where('user_id', auth()->user()->id)->first();
        if($like){
            $like->delete();
            return back();
            
         }else {
            $like = new Favorito();
            $user_id = auth()->user()->id;
            $like->audiolibro_id = $request->id;
            $like->user_id = $user_id;
            $like->save();
            return back();
           
        }

    }


    public function favoritos_destroy($id)
    {
       
        Favorito::where('id',$id)->delete();
        return response()->json(['result' => 'Borrado']);
    }
        

    public function visualizar_publicidad($id)
    {
          
          $publicidad = Publicidad::where('id',$id)->first();
          //Contador de visita
          $contador = 1;
          $views = $publicidad->view;
          $suma = $views + $contador;
          $publicidad->update([
              "view" => $suma
          ]);
        return redirect($publicidad->link);
    }


}
