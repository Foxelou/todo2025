<?php

namespace App\Http\Controllers;

use App\Models\UsersTodos;
use Illuminate\Http\Request;

class UsersTodosController extends Controller
{
    /**
     * Affiche la liste des catégories.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeUsersTodos()
    {
        return view("home", ["todos_user" => UsersTodos::all()]);
    }
}
