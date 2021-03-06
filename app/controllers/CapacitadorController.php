<?php


class CapacitadorController
{
    /* Guarda un capacitador */
    public function store($res)
    {
        $capacitador = new Capacitador();
        $capacitador->set(...array_values($res));
        return $capacitador->save();
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
}
