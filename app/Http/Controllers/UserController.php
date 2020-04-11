<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('id', 'DESC')->paginate(20);

        return view('admin.usuarios')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crearUsuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->route('users.index')->with('mensaje', 'Se creo con exito el usuario: '.$usuario->name.' '. $usuario->lastname.'!');

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
        $usuario = User::find($id);

        return view('admin.editarUsuario')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->email = $request->email;
        $usuario->type = $request->type;
        $usuario->save();

        return redirect()->route('users.index')->with('edicion', 'Se ha editado con exito a: '.$usuario->name.' '.$usuario->lastname);
    }

    public function blanquearPassword(Request $request, $id)
    {
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
            return redirect()->back()->withErrors($validator);
        }
        else{
            $usuario = User::find($id);
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            return redirect()->route('users.index')->with('edicion', 'Se ha blanqueado la contraseña de: '.$usuario->name.' '.$usuario->lastname);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->route('users.index')->with('usuarioBorrado', 'Se ha eliminado a: '.$usuario->name.' '.$usuario->lastname);
    }
}
