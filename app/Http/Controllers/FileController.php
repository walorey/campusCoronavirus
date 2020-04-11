<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //NOTA: COMO CREE EL MODELO, LA MIGRACION Y EL CONTROLADOR JUNTOS, LAS FUNCIONES NO RECIBEN ID SINO EL OBJETO

    public function index()
    {
        $archivos = File::orderBy('id', 'DESC')->paginate(20);
        return view('admin.archivos')->with('archivos', $archivos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subirArchivo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request)
    {   $archivo = new File($request->all());


        $fileRequest = $request->file('archivo');
        $ruta = Storage::disk('public')->put('files', $fileRequest);
        $archivo->ruta = $ruta;
        $archivo->save();

        return redirect()->route('files.index')->with('mensaje', 'Se subió: '.$archivo->name.' correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $archivo = $file;

        return view('admin.editarArchivo')->with('archivo', $archivo);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $archivo = $file;

        $archivo->name = $request->name;
        $archivo->modulo = $request->modulo;
        $archivo->descripcion = $request->descripcion;

        if($request->hasFile('archivo')){
        $fileRequest = $request->file('archivo');
        $ruta = Storage::disk('public')->put('files', $fileRequest);
        $archivo->ruta = $ruta;
        }
        $archivo->save();

        return redirect()->route('files.index')->with('edicion', 'Se edito con exito: '.$archivo->name);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $archivo = $file;

        $archivo->delete();

        return redirect()->route('files.index')->with('archivoBorrado', 'Se ha eliminado el archivo "'.$archivo->name.'"');
    }
}
