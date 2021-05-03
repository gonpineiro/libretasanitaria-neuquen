<?php
class LogController
{
    /* Guarda un log */
    public function store($res)
    {
        $log = new Log();
        $log->set(...array_values($res));
        $log->save();
    }

    /* Busca todos los logs */
    static public function index($param = [], $ops = [])
    {
        return Log::list($param, $ops);
    }

    /* Busca un log */
    static public function get($params)
    {
        return Log::get($params);
    }
}
