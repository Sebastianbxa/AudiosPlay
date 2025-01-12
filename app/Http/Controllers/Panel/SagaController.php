<?php
namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use App\Models\Audio;
use App\Models\Saga;
use App\Models\Sagas_and_audiobook;
use Illuminate\Http\Request;

class SagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sagas = Saga::all();
        $audios = Audio::orderBy('titulo', 'asc')->get();
        return view('panel.saga')
        ->with('audios', $audios)
        ->with('sagas',$sagas);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sagas = new Saga();
        $sagas->saga_codigo = $request->input('saga_codigo');
       
               
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPatch = 'images/sagas/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSucces = $request->file('imagen')->move($destinationPatch, $filename);
            $sagas->imagen = $destinationPatch . $filename;
        }
        $sagas->nombre = $request->input('titulo');
        $sagas->save();
        return back()->with('mensaje', 'ok'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($saga)
    {
        $sagas_id = $saga;
        $audios = Audio::orderBy('titulo', 'asc')->get();
        $sagas = Sagas_and_audiobook::where('sagas_id',$sagas_id)->latest()->get();
        // dd($saga_codigo);
	    return view('panel.edit_saga')->with('sagas', $sagas)
        ->with('audios',$audios)
        ->with('saga',$saga);
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
        $saga = Saga::find($id);
       
        $saga->update([
            "saga_codigo" => $request["saga_codigo"],
            "nombre" => $request["titulo"],
            "audiolibro_id" => $request["audiolibro_id"],
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPatch = 'images/saga/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSucces = $request->file('imagen')->move($destinationPatch, $filename);
            $saga->imagen = $destinationPatch . $filename;
            $saga->save();
        }


		return redirect('/panel/sagas')->with('mensaje', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$audio = Audio::find($id);
        $saga = Saga::where('id',$id)->first();
        $saga->delete();
        return back();
    }

    
    public function sagas_audio_add(Request $request, $id)
    {
        $sagas_and_book = new Sagas_and_audiobook();
        $sagas_and_book->sagas_id = $id;
        $sagas_and_book->audiolibros_id = $request->input('audiolibro_id');
        $sagas_and_book->save();
        return back()->with('mensaje', 'ok'); 

    }

    public function sagas_audio_destroy($saga)
    {
        $id = $saga;
        //$audio = Audio::find($id);
        $saga = Sagas_and_audiobook::where('id',$id)->first();
        $saga->delete();
        return back();
    }

}
