<?php

namespace App\Controllers;

use App\Models\Capacitador;

class CapacitadorController
{
    /* Guarda un capacitador */
    public function store($res)
    {
        $capacitador = new Capacitador();
        $values = array_values($res);
        $capacitador->set(...$values);
        $capacitador->save();
    }

    /* Busca todos los capacitador */
    public static function index($param = [], $ops = [])
    {
        return Capacitador::list($param, $ops);
    }

    /* Busca un capacitador */
    public static function get($id)
    {
        return Capacitador::get($id);
    }

    /* Actualiza un capacitador */
    public static function update($res, $id)
    {
        return Capacitador::update($res, $id);
    }

    /* Obtenemos el utlimo registro */
    public static function getLast()
    {
        return Capacitador::getLast();
    }
}
