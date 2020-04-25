<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\nuevaPregunta;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Question::orderBy('id', 'DESC')->paginate(10);

        return view('foro.home')->with('preguntas', $preguntas);
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
        // $users y $user es para notificar, no confundir con el usuario que pregunta
        $users = User::where('type', '=', 'admin')->get();
        $pregunta = new Question($request->all());
        $usuario = Auth::user();
        $pregunta->user_id = $usuario->id;
        $pregunta->save();

        foreach ($users as $user) {
            $user->notify(new nuevaPregunta($usuario, $pregunta));
        }

        return redirect()->route('foro.index')->with('mensaje', 'Se publicó con éxito tu pregunta!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pregunta = Question::find($id);

        return view('foro.pregunta')->with('pregunta', $pregunta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregunta = Question::find($id);
        $pregunta->delete();

        return redirect()->route('foro.index')->with('preguntaBorrada', 'Se elimino la pregunta: "'.$pregunta->titulo.'"');
    }
}
