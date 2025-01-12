<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use App\Models\Audio;
use App\Models\Top;
use Illuminate\Http\Request;

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $tops = Top::latest()->get(); 
        $audios = Audio::orderBy('titulo', 'asc')->get();

        return view('panel.top')
        ->with('audios',$audios)
        ->with('tops',$tops);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $top = new Top();
        $top->audiolibros_id = $request->input('audiolibros_id');
        $top->posicion = $request->input('posicion');
        $top->save();
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
        $top = Top::find($id);
        $top->update([
            "posicion" => $request["posicion"]
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
        $top = Top::where('id',$id)->first();
        $top->delete();
        return back();
    }


    public function top_destroy_all()
    {
       
        Top::query()->delete();
        return back();
    }


}
