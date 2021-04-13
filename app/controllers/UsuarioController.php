<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController
{
    /* Guarda un usuario */
    public function store($res)
    {
        $usuario = new Usuario();
        $values = array_values($res);
        $usuario->set(...$values);
        $usuario->save();
    }

    /* Busca todos los usuarios */
    static public function index( $param = [], $ops = [] )
    {
        return Usuario::list($param, $ops);
    }

    /* Busca un usuario */
    static public function get($id)
    {
        return Usuario::get($id);
    }

    /* Actualiza un usuario */
    static public function update($res, $id)
    {
       
        return Usuario::update($res, $id);
    }

}
