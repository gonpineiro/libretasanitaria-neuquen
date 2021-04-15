<?php

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
    static public function index($param = [], $ops = [])
    {
        return Usuario::list($param, $ops);
    }

    /* Busca un usuario */
    static public function get($params)
    {
        return Usuario::get($params);
    }

    /* Actualiza un usuario */
    static public function update($res, $id)
    {
        return Usuario::update($res, $id);
    }
}
