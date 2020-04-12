<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use app\User;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('configuracion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cambiarEmail(Request $request)
    {
        $usuario = Auth::user();
        $usuario->email = $request->email;
        $usuario->save();

        return redirect()->route('configuracion.index')->with('mensaje', 'Se modifico su email a '.$request->email);
    }

    public function cambiarPassword(Request $request)
    {
        $password_actual = $request->password_actual;


        if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $password_actual])) {
            return redirect()->route('configuracion.index')->with('error', 'La contraseña actual no es correcta');
        }

        $rules = [
            'password' => 'required|confirmed'
        ];

        $messages = [
            'required' => 'La contraseña es requerida.',
            'confirmed' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if($validator->fails())
        {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }
        else{
            $usuario = Auth::user();
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            return redirect()->route('configuracion.index')->with('mensaje', 'Se ha modificado la contraseña');
        }
    }
}
