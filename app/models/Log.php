<?php

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id_usuario
 * @property int $id_solicitud
 * @property int $id_capacitador
 * @property int $error
 * @property int $class
 * @property int $metodo
 * @property string $fecha_alta
 *
 */
class Log
{
    public $id_usuario;
    public $id_solicitud;
    public $id_capacitador;
    public $error;
    public $class;
    public $metodo;
    public $fecha_alta;

    public function __construct()
    {
        $this->id_usuario = "";
        $this->id_solicitud = "";
        $this->id_capacitador = "";
        $this->error = "";
        $this->class = "";
        $this->metodo = "";
        $this->fecha_alta = date('d/m/Y H:i:s');
    }

    public function set($id_usuario, $id_solicitud, $id_capacitador, $error, $class, $metodo)
    {
        $this->id_usuario = $id_usuario;
        $this->id_solicitud = $id_solicitud;
        $this->id_capacitador = $id_capacitador;
        $this->error = $error;
        $this->class = $class;
        $this->metodo = $metodo;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $conn->store(LOG, $array, 'iissssssssss');
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $logs = $conn->search(LOG, $param, $ops);
        return $logs;
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(LOG, $params);
        $log = $conn->fetch_assoc($result);
        return $log;
    }
}
