<?php

namespace App\Http\Controllers;

use App\Models\UsersTodos;
use Illuminate\Http\Response;

class UsersTodosController extends Controller
{
    /**
     * Affiche la liste des catégories.
     *
     * @return Response
     */
    public function listeUsersTodos()
    {
        return view('home', ['todos_user' => UsersTodos::all()]);
    }
}
